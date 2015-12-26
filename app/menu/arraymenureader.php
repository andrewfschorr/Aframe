<?php

namespace Aframe\Menu;

class ArrayMenuReader implements MenuReader
{
    public function readMenu()
    {
        return [
            ['href' => '/', 'text' => 'Homepage'],
            ['href' => '/page-one', 'text' => 'Page One'],
            ['href' => '/page-two', 'text' => 'Page Two'],
        ];
    }
}
