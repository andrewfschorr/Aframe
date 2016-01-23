<?php

namespace Aframe\Controllers;

use Aframe\Models\TaskModel;
use Aframe\Models\ImageModel;
use Aframe\Models\GroupModel;

class Api
{
    public function __construct()
    {
        header('Content-Type: application/json');
        $this->group_model = new GroupModel();
    }

    public function groups()
    {
        echo json_encode($this->group_model->get_groups());
    }

    public function group_images($response_params)
    {
        $group_name = $response_params['group'];
        $group = $this->group_model->group_exists($group_name);
        if (!$group) {
            http_response_code(404);
        } else {
            $image_model = new ImageModel();
            echo json_encode($image_model->get_images($group_name));
        }
    }
}
