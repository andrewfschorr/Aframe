<?php

namespace Aframe\Page;

interface PageReader
{
    public function readBySlug($slug);
}