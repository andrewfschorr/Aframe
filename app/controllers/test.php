<?php

namespace Aframe\Controllers;

class Test
{
    public function __construct()
    {
        error_log('we constructing!');
    }

    public function index()
    {
        error_log('indexing');   
        
    }
}
