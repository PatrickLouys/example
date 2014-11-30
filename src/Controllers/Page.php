<?php

namespace Example\Controllers;

use Http\Response;
use Example\Template\Engine as TemplateEngine;
use Example\Page\PageReader;
use Example\Page\InvalidPageException;

class Page
{
    private $response;
    private $templateEngine;
    private $pageReader;

    public function __construct(
        Response $response,
        TemplateEngine $templateEngine,
        PageReader $pageReader
    ) {
        $this->response = $response;
        $this->templateEngine = $templateEngine;
        $this->pageReader = $pageReader;
    }

    public function show($params)
    {
        $slug = $params['slug'];

        try {
            $data['content'] = $this->pageReader->getContentBySlug($slug);
        } catch (InvalidPageException $e) {
            $this->response->setStatusCode(404);
            return $this->response->setContent('404 - Page not found');
        }
        
        $html = $this->templateEngine->render('Page', $data);
        $this->response->setContent($html);
    }
}