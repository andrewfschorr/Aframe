<?php

namespace Aframe\Controllers;

use Http\Request;
use Http\Response;
use Aframe\Template\FrontendRenderer;
use Aframe\Models\TaskModel;
use Aframe\Models\CategoryModel;
use Aframe\Utils\Util;

class Todo extends Auth_user
{
    protected $request;
    protected $response;
    protected $renderer;

    public function __construct(Request $request, Response $response, FrontendRenderer $renderer)
    {
        parent::__construct($request, $response, $renderer);
        $this->task_model = new TaskModel();
        $this->category_model = new CategoryModel();
    }

    public function index()
    {
        if(!empty(Util::get_session('error_msg'))) {
            $error_msg = Util::get_session('error_msg');
            Util::un_set_session('error_msg');
        }

        $tasks = $this->task_model->get_tasks();
        $categories = $this->category_model->get_categories();
        $data = [
            'tasks' => $tasks,
            'title' => 'To dos!',
            'error' => (isset($error_msg)) ? $error_msg : null,
            'user_id' => (isset($this->user_id)) ? $this->user_id : null,
            'email' => (isset($this->email)) ? $this->email : null,
            'categories' => (isset($categories)) ? $categories : null,
        ];

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
            error_log(print_r($file_array, true));
            if (!is_uploaded_file($file_array['image-file']['tmp_name']) || !getimagesize($file_array['image-file']['tmp_name']) || $file_array['image-file']['error']) {
                Util::set_session('error_msg', 'there was an error with the image');
            }
        }

        //if (!$file_array['image-file']['name'] || !$parameters_array['title']) {
        if (!$parameters_array['title']) {
            Util::set_session('error_msg', 'You didn\'t give a title and image!');
        } else {
            $img = $this->task_model->add_task(array_merge($file_array, $parameters_array));
        }

        header('Location: ' . $_SERVER['REQUEST_URI']);
        exit();
    }

    public function delete_task()
    {
        $task_id = $this->request->getParameter('id', $defaultValue = null);
        $this->task_model->delete_task($task_id);
    }
}
