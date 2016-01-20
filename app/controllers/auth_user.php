<?php

namespace Aframe\Controllers;

use Http\Request;
use Http\Response;
use Aframe\Template\FrontendRenderer;
use Aframe\Models\GroupModel;
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
        $this->group_model = new GroupModel();

        $this->groups = $this->group_model->get_groups();
        $this->data = [
            'user_id' => isset($this->user_id) ? $this->user_id : null,
            'email' => isset($this->email) ? $this->email : null,
            'groups' => isset($this->groups) ? $this->groups : null,
        ];

        if (empty($this->user_id)) {
            Util::set_session('error_msg', 'sorry');
            Util::redirect_and_exit('/login');
        }
    }
}
