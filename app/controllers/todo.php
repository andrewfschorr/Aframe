<?php

namespace Aframe\Controllers;

use Http\Request;
use Http\Response;
use Aframe\Template\FrontendRenderer;
use Aframe\Models\Task;

class Todo extends Auth_user
{
    protected $request;
    protected $response;
    protected $renderer;

    public function __construct(Request $request, Response $response, FrontendRenderer $renderer)
    {
        parent::__construct($request, $response, $renderer);
        $this->task_model = new Task();
    }

    public function index()
    {
        if(!empty($_SESSION['error_msg'])) {
            $error_msg = $_SESSION['error_msg'];
            unset($_SESSION['error_msg']);
        }

        $tasks = $this->task_model->get_tasks();
        $data = [
            'tasks' => $tasks,
            'title' => 'To dos!',
            'error' => (isset($error_msg)) ? $error_msg : null,
            'user_id' => (isset($this->user_id)) ? $this->user_id : null,
            'email' => (isset($this->email)) ? $this->email : null,
        ];

        $html = $this->renderer->render('partials/todo', $data);
        $this->response->setContent($html);
        echo $this->response->getContent();
    }

    public function add_task()
    {
        $file_array = $this->request->getFiles();
        $parameters_array = $this->request->getParameters();
        if (!$file_array['image-file']['name'] || !$parameters_array['title']) {
            $_SESSION['error_msg'] = 'You didn\'t give a title and image!';
        } else {
            $this->task_model->add_task(array_merge($file_array, $parameters_array));
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
