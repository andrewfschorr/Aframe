<?php

namespace Aframe\Controllers;

use Http\Request;
use Http\Response;
use Aframe\Template\FrontendRenderer;
use Aframe\Models\Usermodel;
use Aframe\Utils\Util;

class User
{
    public function __construct(Request $request, Response $response, FrontendRenderer $renderer)
    {
        $this->request = $request;
        $this->response = $response;
        $this->renderer = $renderer;
        $this->user_id = Util::get_session('user_id');
        $this->email = Util::get_session('email');
    }

    public function show_profile()
    {
        $error_msg = Util::get_session('error_msg');
        if(!empty($error_msg)) {
            Util::un_set_session('error_msg');
        }

        $data = array(
            'error'   => (isset($error_msg)) ? $error_msg : null,
            'user_id' => (isset($this->user_id)) ? $this->user_id : null,
            'email' => (isset($this->email)) ? $this->email : null,
        );
        $html = $this->renderer->render('partials/login', $data);
        $this->response->setContent($html);
        echo $this->response->getContent();
    }

}
