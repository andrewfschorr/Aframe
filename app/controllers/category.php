<?php

namespace Aframe\Controllers;

use Http\Request;
use Http\Response;
use Aframe\Models\CategoryModel;

class Category
{
    protected $request;
    protected $response;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
        $this->category_model = new CategoryModel();
    }

    public function delete_category()
    {

    }

    public function add_category()
    {
        $parameters_array = $this->request->getParameters();
        $added_category = $this->category_model->add_category($parameters_array['category']);

        header('Location: ' . '/todo');
        exit();
    }

}
