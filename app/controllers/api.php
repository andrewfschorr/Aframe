<?php

namespace Aframe\Controllers;

use Aframe\Models\TaskModel;

class Api
{
    public function __construct()
    {
        header('Content-Type: application/json');
        $this->task_model = new TaskModel();
    }

    public function todos()
    {
        $tasks = $this->task_model->get_all_tasks();
        echo json_encode($tasks);
    }
}
