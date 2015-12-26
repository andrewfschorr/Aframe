<?php

namespace Aframe\Controllers;

use Http\Request;
use Http\Response;
use Aframe\Template\FrontendRenderer;
use Aframe\Page\PageReader;
use Aframe\Page\InvalidPageException;

class Static_page
{

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
        if (isset($params['slug'])) {
            try {
                $data['content'] = $this->pageReader->readBySlug($params['slug']);
            } catch (InvalidPageException $e) {
                $this->response->setStatusCode(404);
                $this->response->setContent('404 - Page not found');
                echo $this->response->getContent();
                return;
            }
            $data['content'] = $this->pageReader->readBySlug($params['slug']);
            $file_path = 'partials/page';
        } else {
            $uri = $this->request->getUri();
            $file_path = "pages/$uri";
            $data = array();
        }

        $html = $this->renderer->render("$file_path", $data);
        $this->response->setContent($html);
        echo $this->response->getContent();
    }
}
