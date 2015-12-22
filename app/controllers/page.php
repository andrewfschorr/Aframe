<?php

namespace Aframe\Controllers;

use Http\Response;
use Aframe\Template\FrontendRenderer;
use Aframe\Page\PageReader;
use Aframe\Page\InvalidPageException;

class Page
{

    private $response;
    private $renderer;
    private $pageReader;

    public function __construct(
        Response $response,
        FrontendRenderer $renderer,
        PageReader $pageReader
    ) {
        $this->response = $response;
        $this->renderer = $renderer;
        $this->pageReader = $pageReader;
    }

    public function index($params)
    {
        $slug = $params['slug'];
        var_dump($params);   
        try {
            $data['content'] = $this->pageReader->readBySlug($slug);
        } catch (InvalidPageException $e) {
            var_dump($e);
            $this->response->setStatusCode(404);
            $this->response->setContent('404 - Page not found');
            echo $this->response->getContent();
            return;
        }

        $html = $this->renderer->render('partials/page', $data);
        $this->response->setContent($html);
        echo $this->response->getContent(); 
    }
}
