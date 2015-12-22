<?php

namespace Aframe\Controllers;

use Http\Request;
use Http\Response;
use Aframe\Template\FrontendRenderer;
use Aframe\Models\Task;

class Todo
{
    private $request;
    private $response;
    private $renderer;

    public function __construct(Request $request, Response $response, FrontendRenderer $renderer)
    {
        session_start();
        $this->request = $request;
        $this->response = $response;
        $this->renderer = $renderer;
        $this->task = new Task(DB_HOST, DB_USER, DB_PASS, DB);
    }

    public function index()
    {
        if(!empty($_SESSION['error_msg'])) {
            $error_msg = $_SESSION['error_msg'];
            unset($_SESSION['error_msg']);
        }

        $tasks = $this->task->get_tasks();
        $data = [
            'tasks' => $tasks,
            'title' => 'To dos!',
            'error' => (isset($error_msg)) ? $error_msg : null,
        ];

        $html = $this->renderer->render('todo', $data); 
        $this->response->setContent($html);
        echo $this->response->getContent(); 
    }

    public function add_task()
    {
        $task = $this->request->getParameter('task', $defaultValue = null);
        if ($task) {
            $this->task->add_task($task); 
        } else {
            $_SESSION['error_msg'] = 'You can\'t have a blank task!';
        }
        header('Location: ' . $_SERVER['REQUEST_URI']);
        exit();    
    }

    public function delete_task()
    {   
        $task_id = $this->request->getParameter('id', $defaultValue = null);
        $this->task->delete_task($task_id);
    }
}
