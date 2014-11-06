<?php

namespace Example\Template;

interface Renderable
{
    public function render($template, $data = []);
}