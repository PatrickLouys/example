<?php

namespace Example\Template;

interface Engine
{
    public function render($template, $data = []);
}