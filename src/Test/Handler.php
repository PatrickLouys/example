<?php

namespace Example\Test;

use Http\Response;

class Handler
{
    private $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function helloWorld()
    {
        $this->response->setContent('Hello World!');
    }
}