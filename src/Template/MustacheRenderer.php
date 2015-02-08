<?php

namespace Example\Template;

use Mustache_Engine;

class MustacheRenderer implements Renderer
{
    private $renderer;

    public function __construct(Mustache_Engine $renderer)
    {
        $this->renderer = $renderer;
    }

    public function render($template, $data = [])
    {
        return $this->renderer->render($template, $data);
    }
}