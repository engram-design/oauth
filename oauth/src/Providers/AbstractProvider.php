<?php

/**
 * Craft OAuth by Dukt
 *
 * @package   Craft OAuth
 * @author    Benjamin David
 * @copyright Copyright (c) 2015, Dukt
 * @link      https://dukt.net/craft/oauth/
 * @license   https://dukt.net/craft/oauth/docs/license
 */


namespace Dukt\OAuth\Providers;

use \Craft\Craft;
use \Craft\LogLevel;
use \Craft\Oauth_TokenRecord;
use \Craft\Oauth_TokenModel;
use \Craft\Oauth_ProviderInfosRecord;
use \Craft\Oauth_ProviderInfosModel;
use \Craft\UrlHelper;

use OAuth\Common\Storage\Session;
use OAuth\Common\Consumer\Credentials;

abstract class AbstractProvider {

    public $class;
    public $storage = null;
    public $token = null;
    public $provider = null;
    protected $service = null;
    protected $scopes = array();

    public function __construct()
    {
        // storage
        $this->storage = new Session();
    }

    public function getHandle()
    {
        $class = $this->getClass();

        $handle = strtolower($class);

        return $handle;
    }

    public function getClass()
    {
        // from : Dukt\OAuth\Providers\Dribbble
        // to : Dribbble

        $nsClass = get_class($this);

        $class = substr($nsClass, strrpos($nsClass, "\\") + 1);

        return $class;
    }

    public function getTokens()
    {
        return \Craft\craft()->oauth->getTokensByProvider($this->getHandle());
    }

    public function initService()
    {
        $handle = $this->getHandle();
        $serviceFactory = new \OAuth\ServiceFactory();
        $callbackUrl = \Craft\craft()->oauth->callbackUrl($handle);

        if($this->provider)
        {
            $credentials = new Credentials(
                $this->provider->clientId,
                $this->provider->clientSecret,
                $callbackUrl
            );
        }
        else
        {
            $credentials = new Credentials(
                'client id not provided',
                'client secret not provided',
                $callbackUrl
            );
        }

        $this->service = $serviceFactory->createService($handle, $credentials, $this->storage, $this->scopes);
    }

    public function getAuthorizationMethod()
    {
        return null;
    }

    public function getAuthorizationUri($params)
    {
        return $this->service->getAuthorizationUri($params);
    }

    public function requestRequestToken()
    {
        return $this->service->requestRequestToken();
    }

    public function hasRefreshToken()
    {
        return method_exists($this->service, 'refreshAccessToken');
    }

    public function requestAccessToken($code)
    {
        return $this->service->requestAccessToken($code);
    }

    public function refreshAccessToken($token)
    {
        if(method_exists($this->service, 'refreshAccessToken'))
        {
            // $realToken = \Craft\craft()->oauth->getRealToken($token);

            // return $this->service->refreshAccessToken($realToken);
            return $this->service->refreshAccessToken($token);
        }
        else
        {
            return false;
        }
    }

    public function setInfos(Oauth_ProviderInfosModel $provider)
    {
        // set provider
        $this->provider = $provider;

        // re-initialize service with new scope
        $this->initService();
    }

    public function getInfos()
    {
        return $this->provider;
    }

    public function setScopes(array $scopes)
    {
        // set scope
        $this->scopes = $scopes;

        // re-initialize service with new scope
        $this->initService();
    }

    public function getScopes()
    {
        return $this->scopes;
    }

    public function getParams()
    {
        return array();
    }

    public function getStorage()
    {
        if(!$this->storage)
        {
            $this->storage = new Session();
        }
    }

    public function retrieveAccessToken()
    {
        return $this->storage->retrieveAccessToken($this->getClass());
    }

    public function setToken(Oauth_TokenModel $token)
    {
        $this->token = $token;
    }

    public function getToken()
    {
        return $this->token;
    }

    /**
     * Is Configured ?
     */
    public function isConfigured()
    {
        if(!empty($this->provider->clientId))
        {
            return true;
        }

        return false;
    }

    /**
     * Get Guzzle Subscriber
     */
    public function getSubscriber()
    {
        $headers = array();
        $query = array();

        $infos = $this->getInfos();
        $token = $this->token;

        switch($this->oauthVersion)
        {
            case 1:
                $oauth = new \Guzzle\Plugin\Oauth\OauthPlugin(array(
                    'consumer_key' => $infos->clientId,
                    'consumer_secret' => $infos->clientSecret,
                    'token' => $token->accessToken,
                    'token_secret' => $token->secret
                ));

                return $oauth;

                break;

            case 2:
                $config = array(
                    'consumer_key' => $infos->clientId,
                    'consumer_secret' => $infos->clientSecret,
                    'authorization_method' => $this->getAuthorizationMethod(),
                    'access_token' => $token->accessToken,
                );

                $oauth = new \Dukt\OAuth\Guzzle\Plugin\Oauth2Plugin($config);

                return $oauth;

                break;
        }
    }

    /**
     * Get Account (alias)
     *
     * @deprecated Deprecated in 1.0.
     * @return array
     */
    public function getAccount()
    {
        return $this->getUserDetails();
    }
}