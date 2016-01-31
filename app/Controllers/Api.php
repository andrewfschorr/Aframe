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
        $group = $this->group_model->get_groups();
        if ($group) {
            $response = array(
                'status' => 200,
                'groups' => $group,
            );
        } else {
            $response = array(
                'status' => 500
            );
        }

        echo json_encode($response);
    }

    public function group_images($response_params)
    {
        $group_name = $response_params['group'];
        $group = $this->group_model->group_exists($group_name);
        if (!$group) {
            http_response_code(500);
            echo json_encode(array('status' => 500));
        } else {
            $image_model = new ImageModel();
            echo json_encode(array(
                'status' => 200,
                'images' => $image_model->get_images($group_name),
            ));
        }
    }

    public function all_images()
    {
        $image_model = new ImageModel();
        $images = $image_model->get_all_images();
        echo json_encode(array(
            'status' => 200,
            'images' => $images,
        ));
    }

    public function featured_images()
    {
        $image_model = new ImageModel();
        $images = $image_model->get_featured_images();

        $status = ($images) ? 200 : 500;

        echo json_encode(array(
            'status' => $status,
            'images' => $images,
        ));
    }
}
