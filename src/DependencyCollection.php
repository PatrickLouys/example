<?php

namespace Example;

use Auryn\Provider;

class DependencyCollection
{
    public function __construct(Provider $injector)
    {
        $this->injector = $injector;
    }

    public function addDependencies()
    {
        $this->addHttpDependencies();
    }

    private function addHttpDependencies()
    {
        $this->injector->share('Http\CookieBuilder');
        $this->injector->delegate('Http\CookieBuilder', function($environment){
            $cookieBuilder = new Http\CookieBuilder;
            $cookieBuilder->setDefaultSecure($environment === 'production');
            return $cookieBuilder;
        });

        $this->injector->alias('Http\Response', 'Http\HttpResponse');
        $this->injector->share('Http\HttpRequest');
        $this->injector->define('Http\HttpRequest', [
            ':get' => $_GET,
            ':post' => $_POST,
            ':cookies' => $_COOKIE,
            ':files' => $_FILES,
            ':server' => $_SERVER,
        ]);

        $this->injector->alias('Http\Request', 'Http\HttpRequest');
        $this->injector->share('Http\HttpResponse');
    }
}