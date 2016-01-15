<?php

namespace Aframe\Controllers;

use Http\Request;
use Http\Response;
use Aframe\Template\FrontendRenderer;
use Aframe\Models\PageModel;
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
        $this->page_model = new PageModel();

        $this->pages = $this->page_model->get_pages();

        $this->data = [
            'user_id' => isset($this->user_id) ? $this->user_id : null,
            'email' => isset($this->email) ? $this->email : null,
            'pages' => isset($this->pages) ? $this->pages : null,
        ];

        if (empty($this->user_id)) {
            error_log('logut');
            Util::set_session('error_msg', 'sorry');
            Util::redirect_and_exit('/login');
        }
    }
}
