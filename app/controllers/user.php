<?php 

namespace Aframe\Controllers;

use Http\Request;
use Http\Response;
use Aframe\Template\FrontendRenderer;
use Aframe\Models\Usermodel;
use Aframe\Utils\Util;

class User extends Auth_User
{
    private $request;
    private $response;    

    protected $renderer;

    public function __construct(Request $request, Response $response, FrontendRenderer $renderer)
    {
        parent::__construct($renderer);
        $this->request = $request;
        $this->response = $response;
    }

    public function show_login()
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

    public function show_signup()
    {
        $error_msg = Util::get_session('error_msg');
        if(!empty($error_msg)) {
            Util::un_set_session('error_msg');
        }

        $form_token = md5(uniqid('auth', true));
        Util::set_session('form_token', $form_token);

        $data = array(
            'form_token' => $form_token,
            'error' => (isset($error_msg)) ? $error_msg : null,
            'user_id' => (isset($this->user_id)) ? $this->user_id : null,
            'email' => (isset($this->email)) ? $this->email : null,
        );
        $html = $this->renderer->render('partials/signup', $data); 
        $this->response->setContent($html);
        echo $this->response->getContent(); 
    }

    public function login()
    {
        $params = $this->request->getParameters();

        if(!$params['email'] || !$params['password'])
        {
            $error_msg = 'Please enter a valid username and password';
        }
        else if (!filter_var($params['email'], FILTER_VALIDATE_EMAIL))
        {
            $error_msg = "Username must be an email";
        }
        else {

            $email = filter_var($params['email'], FILTER_SANITIZE_STRING);
            $password = filter_var($params['password'], FILTER_SANITIZE_STRING);
            $user = new Usermodel(DB_HOST, DB_USER, DB_PASS, DB);
            $results = $user->find_user($email);
            $row = $results->fetch_assoc();
            
            if (sha1($password) === $row['password']) {
                // if already logged in unset the session variables
                if (Util::get_session('user_id')) {
                    Util::un_set_session('user_id');
                    Util::un_set_session('email');
                }
                Util::set_session('user_id', $row['user_id']);
                Util::set_session('email', $row['email']);
                Util::redirect_and_exit($this->request->getUri());
            } else {
                $error_msg = 'wrong password brah';
            }
        }

        if (isset($error_msg)) {
            Util::set_session('error_msg', $error_msg);
            Util::redirect_and_exit($this->request->getUri());
        }
    }

    public function signup()
    {
        $params = $this->request->getParameters();
        if(!$params['email'] || !$params['password'] || !$params['form_token'])
        {
            $error_msg = 'Please enter a valid username and password';
        }
        else if($params['form_token'] != Util::get_session('form_token'))
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
            Util::redirect_and_exit('/login');
        }
    }
}