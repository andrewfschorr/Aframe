<?php 

namespace Aframe\Controllers;
use Aframe\Utils\Util;

use Aframe\Template\FrontendRenderer;

class Auth_user
{

    
    public function __construct(FrontendRenderer $renderer)
    {
        $this->renderer = $renderer;
        $this->user_id = Util::get_session('user_id');
        $this->email = Util::get_session('email');
    }
}