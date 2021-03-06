<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita2b9e72101e8cc668d4f0683320de741
{
    public static $files = array (
        'c964ee0ededf28c96ebd9db5099ef910' => __DIR__ . '/..' . '/guzzlehttp/promises/src/functions_include.php',
        'a0edc8309cc5e1d60e3047b5df6b7052' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/functions_include.php',
        '37a3dc5111fe8f707ab4c132ef1dbc62' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/functions_include.php',
        '5255c38a0faeba867671b61dfda6d864' => __DIR__ . '/..' . '/paragonie/random_compat/lib/random.php',
        'b45b351e6b6f7487d819961fef2fda77' => __DIR__ . '/..' . '/jakeasmith/http_build_url/src/http_build_url.php',
    );

    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\Http\\Message\\' => 17,
        ),
        'L' => 
        array (
            'League\\OAuth2\\Client\\' => 21,
            'League\\OAuth1\\' => 14,
        ),
        'G' => 
        array (
            'GuzzleHttp\\Psr7\\' => 16,
            'GuzzleHttp\\Promise\\' => 19,
            'GuzzleHttp\\' => 11,
        ),
        'D' => 
        array (
            'Dukt\\OAuth\\Guzzle\\Subscribers\\' => 30,
            'Dukt\\OAuth2\\Client\\' => 19,
        ),
        'C' => 
        array (
            'Composer\\Installers\\' => 20,
        ),
        'A' => 
        array (
            'AdamPaterson\\OAuth2\\Client\\' => 27,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-message/src',
        ),
        'League\\OAuth2\\Client\\' => 
        array (
            0 => __DIR__ . '/..' . '/league/oauth2-client/src',
            1 => __DIR__ . '/..' . '/league/oauth2-facebook/src',
            2 => __DIR__ . '/..' . '/league/oauth2-github/src',
            3 => __DIR__ . '/..' . '/league/oauth2-instagram/src',
            4 => __DIR__ . '/..' . '/league/oauth2-linkedin/src',
            5 => __DIR__ . '/..' . '/league/oauth2-google/src',
        ),
        'League\\OAuth1\\' => 
        array (
            0 => __DIR__ . '/..' . '/league/oauth1-client/src',
        ),
        'GuzzleHttp\\Psr7\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/psr7/src',
        ),
        'GuzzleHttp\\Promise\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/promises/src',
        ),
        'GuzzleHttp\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/guzzle/src',
        ),
        'Dukt\\OAuth\\Guzzle\\Subscribers\\' => 
        array (
            0 => __DIR__ . '/../..' . '/subscribers',
        ),
        'Dukt\\OAuth2\\Client\\' => 
        array (
            0 => __DIR__ . '/..' . '/dukt/oauth2-google/src',
            1 => __DIR__ . '/..' . '/dukt/oauth2-vimeo/src',
        ),
        'Composer\\Installers\\' => 
        array (
            0 => __DIR__ . '/..' . '/composer/installers/src/Composer/Installers',
        ),
        'AdamPaterson\\OAuth2\\Client\\' => 
        array (
            0 => __DIR__ . '/..' . '/adam-paterson/oauth2-slack/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita2b9e72101e8cc668d4f0683320de741::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita2b9e72101e8cc668d4f0683320de741::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
