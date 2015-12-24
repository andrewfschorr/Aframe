<?php

namespace Aframe\Controllers;

use Http\Request;
use Http\Response;
use Aframe\Template\FrontendRenderer;
use Aframe\Utils\Util;

class Auth_user
{
    protected $request;
    protected $response;
    protected $renderer;

    public function __construct(Request $request, Response $response, FrontendRenderer $renderer)
    {
        $this->request = $request;
        $this->response = $response;
        $this->renderer = $renderer;
        $this->user_id = Util::get_session('user_id');
        $this->email = Util::get_session('email');

        if (empty($this->user_id)) {
            Util::set_session('error_msg', 'sorry');
            Util::redirect_and_exit('/login');
        }
    }
}
