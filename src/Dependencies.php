<?php

$injector = new \Auryn\Provider;

$injector->share('Http\CookieBuilder');
$injector->delegate('Http\CookieBuilder', function($environment){
    $cookieBuilder = new \Http\CookieBuilder;
    $cookieBuilder->setDefaultSecure($environment === 'production');
    return $cookieBuilder;
});

$injector->alias('Http\Response', 'Http\HttpResponse');
$injector->share('Http\HttpRequest');
$injector->define('Http\HttpRequest', [
    ':get' => $_GET,
    ':post' => $_POST,
    ':cookies' => $_COOKIE,
    ':files' => $_FILES,
    ':server' => $_SERVER,
]);

$injector->alias('Http\Request', 'Http\HttpRequest');
$injector->share('Http\HttpResponse');

$injector->define('Mustache_Engine', [
    ':options' => [
        'loader' => new Mustache_Loader_FilesystemLoader(dirname(__DIR__).'/templates'),
    ],
]);

$injector->alias('Example\Template\Engine', 'Example\Template\MustacheEngineAdapter');


return $injector;