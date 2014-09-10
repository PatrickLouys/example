<?php

$routes = function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/test', [
        'class' => 'Test\Handler',
        'action' => 'helloWorld',
    ]);
};