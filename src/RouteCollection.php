<?php

namespace Example;

use FastRoute\RouteCollector;

class RouteCollection
{
    public function addRoutes(RouteCollector $r)
    {
        $r->addRoute('GET', '/test', [
            'class' => 'Test\Handler',
            'action' => 'helloWorld',
        ]);
    }
}