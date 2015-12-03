<?php

namespace Aframe\Template;

interface Renderer
{
    public function render($template, $data = []);
}