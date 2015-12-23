<?php 

namespace Aframe\Controllers;
use Aframe\Utils\Util;

class Auth_user
{

    public function __construct()
    {
        $this->user_id = Util::get_session('user_id');
        $this->email = Util::get_session('email');
    }
}