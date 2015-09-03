<?php

namespace Example\Menu;

use Http\Request;

class ArrayMenuReader implements MenuReader
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function readMenu()
    {
        $menuItems = [
            ['href' => '/', 'text' => 'Homepage'],
            ['href' => '/page-one', 'text' => 'Page One'],
        ];

        foreach ($menuItems as $key => $item) {
            if ($item['href'] === '/' . $this->getFirstPathSegment()) {
                $menuItems[$key]['active'] = true;
            }
        }

        return $menuItems;
    }

    private function getFirstPathSegment()
    {
        $path = $this->request->getPath();
        return strtok($path, '/');
    }
}