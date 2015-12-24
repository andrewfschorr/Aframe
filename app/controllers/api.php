<?php

namespace Aframe\Controllers;

use Aframe\Models\Task;

class Api
{


    public function __construct()
    {
        header('Content-Type: application/json');
        $this->task_model = new Task();
    }

    public function todos()
    {
        $tasks = $this->task_model->get_tasks();
        echo json_encode($tasks);
    }
}
