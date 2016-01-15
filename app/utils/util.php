<?php

namespace Aframe\Utils;

session_start();

class Util
{
    public static function redirect_and_exit($url)
    {
        header('Location: ' . $url);
        exit();
    }

    public static function set_session($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function get_session($key)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    public static function un_set_session($key)
    {
        unset($_SESSION[$key]);
    }

    public static function destroy_session()
    {
        session_destroy();
    }

    public static function getFullUrl()
    {
        return $_SERVER['HTTP_HOST'];
    }
}
