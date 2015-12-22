<?php 

namespace Aframe\Controllers;

use Http\Request;
use Http\Response;
use Aframe\Template\FrontendRenderer;
use Aframe\Models\Usermodel;

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

    public function index()
    {
        session_start();
        $form_token = md5(uniqid('auth', true));
        $_SESSION['form_token'] = $form_token;

        $data = array(
            'form_token' => $form_token
        );
        $html = $this->renderer->render('signup', $data); 
        $this->response->setContent($html);
        echo $this->response->getContent(); 
    }

    public function signup()
    {
        session_start();
        $params = $this->request->getParameters();
        if(!isset( $params['email'], $params['password'], $params['form_token']))
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
            
            $this->usermodel = new Usermodel(DB_HOST, DB_USER, DB_PASS, DB);
            
            $new_user = $this->usermodel->make_user($email, $password);

            echo '<pre>';
            var_dump($new_user);
            echo '</pre>';
            unset( $_SESSION['form_token'] );

            echo 'whooohoooo';
            // $error_msg = 'New user added';
            // }
            // catch(Exception $e)
            // {
            //     if( $e->getCode() == 23000)
            //     {
            //         $error_msg = 'Username already exists';
            //     }
            //     else
            //     {
            //         $error_msg = 'We are unable to process your request. Please try again later"';
            //     }
            // }
        }
    }
}