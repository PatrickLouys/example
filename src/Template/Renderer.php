<?php

namespace Example\Template;

interface Renderer
{
    public function render($template, $data = []);
}