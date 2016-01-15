<?php

namespace Aframe\Controllers;

use Http\Request;
use Http\Response;
use Aframe\Template\FrontendRenderer;
use Aframe\Models\TaskModel;
use Aframe\Utils\Util;

class Page extends Auth_user
{
    protected $request;
    protected $response;

    public function __construct(Request $request, Response $response, FrontendRenderer $renderer)
    {
        parent::__construct($request, $response, $renderer);
        $this->task_model = new TaskModel();
    }

    public function delete_page()
    {

    }

    public function add_page()
    {
        $parameters_array = $this->request->getParameters();
        $page_name = $this->make_seo_friendly_af($parameters_array['page']); // totally overkill
        if (!$page_name) {
            Util::set_session('error_msg', 'Page name can\'t be blank bruh');
            Util::redirect_and_exit('/todo');
        }
        $added_page = $this->page_model->add_page($page_name);
        Util::redirect_and_exit('/todo');
    }

    public function display_page($response_params)
    {

        $error_msg = Util::get_session('error_msg');
        $page = $response_params['page'];

        $tasks = $this->task_model->get_page_tasks($page);
        $data = [
            'tasks' => !empty($tasks) ? $tasks : null,
            'page' => $page,
            'error' => (isset($error_msg)) ? $error_msg : null,
        ];

        $data = array_merge($data, $this->data); // merge with parent data

        $html = $this->renderer->render('partials/page', $data);
        $this->response->setContent($html);
        echo $this->response->getContent();

        if ($error_msg) {
            Util::un_set_session('error_msg');
        }
    }

    /*
    * This function is totally overkill for this, whatevs
    * from here http://stackoverflow.com/questions/11330480/strip-php-variable-replace-white-spaces-with-dashes
    */
    private function make_seo_friendly_af($string)
    {
        $string = strtolower($string);
        $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
        $string = preg_replace("/[\s-]+/", " ", $string);
        $string = preg_replace("/[\s_]/", "-", $string);
        return $string;
    }

}
