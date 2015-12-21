<?php

namespace Aframe\Controllers;

use Http\Request;
use Http\Response;
use Aframe\Template\FrontendRenderer;
use Aframe\Models\DB;

class Todo
{
    private $request;
    private $response;
    private $renderer;

    public function __construct(Request $request, Response $response, FrontendRenderer $renderer)
    {
        $this->request = $request;
        $this->response = $response;
        $this->renderer = $renderer;
        $this->db = new DB(DB_HOST, DB_USER, DB_PASS, DB);
    }

    public function index()
    {
        $tasks = $this->db->get_tasks();
        
        $data = [
            'tasks' => $tasks,
            'title' => 'To dos!',
        ];

        $html = $this->renderer->render('todo', $data); 
        $this->response->setContent($html);
        echo $this->response->getContent(); 
    }

    public function add_task()
    {
        $task = $this->request->getParameter('task', $defaultValue = null);
        $this->db->add_task($task);
        header('Location: ' . $_SERVER['REQUEST_URI']);
        exit();
    }

    public function delete_task()
    {   
        $task_id = $this->request->getParameter('id', $defaultValue = null);
        $this->db->delete_task($task_id);
    }
}
