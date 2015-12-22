<?php 

namespace Aframe\Controllers;

use Http\Request;
use Http\Response;
use Aframe\Template\FrontendRenderer;
use Aframe\Models\Usermodel;
use Aframe\Utils\Util;

class User
{
    private $request;
    private $response;
    private $renderer;

    public function __construct(Request $request, Response $response, FrontendRenderer $renderer)
    {
        $this->request = $request;
        $this->response = $response;
        $this->renderer = $renderer;
    }

    public function test()
    {
        echo 'ellO!';
    }

    public function index()
    {
        session_start();

        $error_msg = Util::get_session('error_msg');
        if(!empty($error_msg)) {
            Util::un_set_session('error_msg');
        }

        $form_token = md5(uniqid('auth', true));
        Util::set_session('form_token', $form_token);

        $data = array(
            'form_token' => $form_token,
            'error' => (isset($error_msg)) ? $error_msg : null,
        );
        $html = $this->renderer->render('partials/signup', $data); 
        $this->response->setContent($html);
        echo $this->response->getContent(); 
    }

    public function signup()
    {
        session_start();
        $params = $this->request->getParameters();
        if(!$params['email'] || !$params['password'] || !$params['form_token'])
        {
            $error_msg = 'Please enter a valid username and password';
        }
        else if( $params['form_token'] != $_SESSION['form_token'])
        {
            $error_msg = 'Invalid form submission';
        }
        else if (strlen( $params['email']) > 30 || strlen($params['email']) < 4)
        {
            $error_msg = 'Incorrect Length for Username';
        }
        else if (strlen( $params['password']) > 30 || strlen($params['password']) < 4)
        {
            $error_msg = 'Incorrect Length for Password';
        }
        else if (!filter_var($params['email'], FILTER_VALIDATE_EMAIL))
        {
            $error_msg = "Username must be an email";
        }
        // not the best, lets validate password eventually
        // else if (ctype_alnum($params['password']) != true) 
        else
        {
            $email = filter_var($params['email'], FILTER_SANITIZE_STRING);
            $password = filter_var($params['password'], FILTER_SANITIZE_STRING);

            $password = sha1($password);
            
            $user = new Usermodel(DB_HOST, DB_USER, DB_PASS, DB);
            
            
            $results = $user->check_used_email($email);
            if (!$results) {
                $error_msg = 'There was a database error';
            } else {
                if ($results->num_rows) {
                    $error_msg = 'That email is alrady taken, try another one';
                } else {
                    $new_user = $user->make_user($email, $password);        
                    if (!$new_user) {
                        $error_msg = 'There was an error signging up';
                    }
                }
            }
        }

        if (isset($error_msg)) {
            Util::set_session('error_msg', $error_msg);
            Util::redirect_and_exit($this->request->getUri());
        } else {
            //Util::redirect_and_exit('/login');
            var_dump($user);
        }
    }
}