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
use Dukt\OAuth\base\Provider;

class Instagram extends Provider {

    public $consoleUrl = 'http://instagram.com/developer/clients/';
    public $oauthVersion = 2;

    /**
     * Get Name
     *
     * @return string
     */
    public function getName()
    {
        return 'Instagram';
    }

    /**
     * Scopes
     *
     * @return array
     */
    protected $scopes = array(
        'basic'
    );

    /**
     * Create Instagram Provider
     *
     * @return Instagram
     */
    public function createProvider()
    {
        $config = [
            'clientId' => $this->providerInfos->clientId,
            'clientSecret' => $this->providerInfos->clientSecret,
            'redirectUri' => $this->getRedirectUri(),
        ];

        return new \Dukt\OAuth\OAuth2\Client\Provider\Instagram($config);
    }
}