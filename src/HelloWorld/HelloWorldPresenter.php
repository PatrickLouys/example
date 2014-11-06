<?php

namespace Example\HelloWorld;

use Http\Request;
use Http\Response;
use Example\Template\Engine as TemplateEngine;

class HelloWorldPresenter
{
    private $request;
    private $response;
    private $templateEngine;

    public function __construct(
        Request $request, 
        Response $response,
        TemplateEngine $templateEngine
    ) {
        $this->request = $request;
        $this->response = $response;
        $this->templateEngine = $templateEngine;
    }

    public function hello()
    {
        $data = [
            'name' => $this->request->getParameter('name', 'stranger'),
        ];
        $content = $this->templateEngine->render('HelloWorld/Hello', $data);
        $this->response->setContent($content);
    }
}