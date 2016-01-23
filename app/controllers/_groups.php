<?php

namespace Aframe\Controllers;

use Http\Request;
use Http\Response;
use Aframe\Template\FrontendRenderer;
use Aframe\Models\TaskModel;
use Aframe\Utils\Util;

class Groups extends Auth_user
{
    protected $request;
    protected $response;
    protected $renderer;

    public function __construct(Request $request, Response $response, FrontendRenderer $renderer)
    {
        parent::__construct($request, $response, $renderer);
        $this->task_model = new TaskModel();
    }

    public function index()
    {
        if(!empty(Util::get_session('error_msg'))) {
            $error_msg = Util::get_session('error_msg');
            Util::un_set_session('error_msg');
        }

        $data = [
            'title' => 'Groups',
            'error' => isset($error_msg) ? $error_msg : null,
        ];

        $data = array_merge($data, $this->data); // merge with parent data

        $html = $this->renderer->render('partials/todo', $data);
        $this->response->setContent($html);
        echo $this->response->getContent();
    }

    public function add_task()
    {
        $file_array = $this->request->getFiles();
        $parameters_array = $this->request->getParameters();

        // if theres an image set
        if ( $file_array['image-file']['size'] ){
            if (!is_uploaded_file($file_array['image-file']['tmp_name']) || !getimagesize($file_array['image-file']['tmp_name']) || $file_array['image-file']['error']) {
                Util::set_session('error_msg', 'there was an error with the image');
            }
        }

        if (!$parameters_array['title']) {
            Util::set_session('error_msg', 'You didn\'t give a title and image!');
        } else {
            $img = $this->task_model->add_task(array_merge($file_array, $parameters_array));
        }

        Util::redirect_and_exit($this->request->getReferer());
    }

    public function delete_task()
    {
        $task_id = $this->request->getParameter('id', $defaultValue = null);
        $this->task_model->delete_task($task_id);
    }
}
