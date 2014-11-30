<?php

namespace Example\Controllers;

use Http\Request;
use Http\Response;
use Example\Template\Engine as TemplateEngine;

class Homepage
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

    public function show()
    {
        $data = [
            'name' => $this->request->getParameter('name', 'stranger'),
        ];
        $html = $this->templateEngine->render('Homepage', $data);
        $this->response->setContent($html);
    }
}