<?php

namespace Aframe\Controllers;

use Http\Request;
use Http\Response;
use Aframe\Template\FrontendRenderer;
use Aframe\Models\Usermodel;

class User extends Auth_user
{
    public function __construct(Request $request, Response $response, FrontendRenderer $renderer)
    {
        parent::__construct($request, $response, $renderer);
    }

    public function show_profile()
    {
        $data = array(
            'user_id' => (isset($this->user_id)) ? $this->user_id : null,
            'email' => (isset($this->email)) ? $this->email : null,
        );
        $html = $this->renderer->render('partials/profile', $data);
        $this->response->setContent($html);
        echo $this->response->getContent();
    }

}
