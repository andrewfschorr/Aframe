<?php

namespace Aframe\Controllers;

use Http\Request;
use Http\Response;
use Aframe\Template\FrontendRenderer;
use Aframe\Page\PageReader;
use Aframe\Page\InvalidPageException;

class Static_page
{
    private $request;
    private $response;
    private $renderer;
    private $pageReader;

    public function __construct(Request $request, Response $response, FrontendRenderer $renderer, PageReader $pageReader)
    {
        $this->request = $request;
        $this->response = $response;
        $this->renderer = $renderer;
        $this->pageReader = $pageReader;
    }

    public function index($params)
    {
        try {
            $page_contents = $this->pageReader->readBySlug($params['slug']);
        } catch (InvalidPageException $e) {
            $this->response->setStatusCode(404);
            $this->response->setContent('404 - Page not found');
            echo $this->response->getContent();
            return;
        }

        $this->response->setContent($page_contents);
        echo $this->response->getContent();
    }
}
