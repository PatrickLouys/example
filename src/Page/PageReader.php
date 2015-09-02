<?php

namespace Example\Page;

interface PageReader
{
    public function readBySlug($slug);
}