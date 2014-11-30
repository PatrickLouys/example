<?php

namespace Example\Page;

interface PageReader
{
    public function getContentBySlug($slug);
}