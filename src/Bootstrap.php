<?php

require '../vendor/autoload.php';

error_reporting(E_ALL);

$environment = 'development'; // todo: detect environment

/**
 * Register the error handler
 */
$woops = new \Whoops\Run;
if ($environment === 'development') {
    $woops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
} else {
    $woops->pushHandler(function($e){
        echo 'Friendly error page';
    });
    $woops->pushHandler(function($e){
        // send email to dev with error
    });
}
$woops->register();

/**
 * Set up the dependency injector
 */
$injector = new Auryn\Provider;

require 'Dependencies.php';

/**
 * Set up the router and dispatch
 */
require 'Routes.php';

$request = $injector->make('Http\HttpRequest');
$response = $injector->make('Http\HttpResponse');

$dispatcher = FastRoute\simpleDispatcher($routes);
$routeInfo = $dispatcher->dispatch($request->getMethod(), $request->getUri());
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        $response->setStatusCode(404);
        $response->setContent('404 - Page not found');
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $response->setStatusCode(405);
        $response->setContent('405 - Method not allowed');
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];

        if (!array_key_exists('class', $handler)) {
            throw new Exception('Route handler must have a class defined');
        }

        if (!array_key_exists('action', $handler)) {
            throw new Exception('Route handler must have am action defined');
        }

        $class = $injector->make('Example\\' . $handler['class']);
        $class->$handler['action']($vars);

        break;
}

/**
 * Send the http response
 */
foreach ($response->getHeaders() as $header) {
    header($header);
}

echo $response->getContent();