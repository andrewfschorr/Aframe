<?php

namespace Aframe\Controllers;

class Test
{
    public function __construct()
    {
        echo 'we constructing!';
    }

    public function index($params)
    {
        
        $data['name'] = $params['name'];
        
        // try {
        //     $data['content'] = $this->pageReader->readBySlug($slug);
        // } catch (InvalidPageException $e) {
        //     var_dump($e);
        //     $this->response->setStatusCode(404);
        //     $this->response->setContent('404 - Page not found');
        //     echo $this->response->getContent();
        //     return;
        // }

        // $html = $this->renderer->render('Page', $data);
        //$this->response->setContent($html);
        echo $data['name']; 
    }
}
