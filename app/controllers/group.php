<?php

namespace Aframe\Controllers;

use Http\Request;
use Http\Response;
use Aframe\Template\FrontendRenderer;
use Aframe\Models\ImageModel;
use Aframe\Utils\Util;

class Group extends Auth_user
{
    protected $request;
    protected $response;

    public function __construct(Request $request, Response $response, FrontendRenderer $renderer)
    {
        parent::__construct($request, $response, $renderer);
        $this->image_model = new ImageModel();
    }

    public function index()
    {
        if(!empty(Util::get_session('error_msg'))) {
            $error_msg = Util::get_session('error_msg');
            Util::un_set_session('error_msg');
        }

        $data = [
            'title' => 'Groups',
            'error' => isset($error_msg) ? $error_msg : null,
        ];

        $data = array_merge($data, $this->data); // merge with parent data

        $html = $this->renderer->render('partials/groups', $data);
        $this->response->setContent($html);
        echo $this->response->getContent();
    }

    public function delete_group($id)
    {
        $group_name = $this->request->getParameter('id', $defaultValue = null);
        $group_delete = $this->group_model->delete_group($group_name);

        if (!$group_delete) {
            Util::set_session('error_msg', 'Sorry, can\'t delete a non-empty group');
            echo json_encode(
                array(
                    'status'  => 'error',
                    'type'    => 'group',
                    'message' => '',
                )
            );
        } else {
            echo json_encode(
                array(
                    'status'  => 'success',
                    'type'    => 'group',
                    'message' => '',
                )
            );
        }
    }

    public function add_group()
    {
        $parameters_array = $this->request->getParameters();
        $group_name = $this->make_seo_friendly_af($parameters_array['group']); // totally overkill
        if (!$group_name) {
            Util::set_session('error_msg', 'Page name can\'t be blank bruh');
            Util::redirect_and_exit('/groups');
        }
        $added_page = $this->group_model->add_group($group_name);
        Util::redirect_and_exit('/groups');
    }

    public function display_group($response_params)
    {

        $error_msg = Util::get_session('error_msg');
        $group = $response_params['group'];
        $images = $this->image_model->get_images($group);
        $data = [
            'images' => !empty($images) ? $images : null,
            'group' => $group,
            'error' => (isset($error_msg)) ? $error_msg : null,
        ];

        $data = array_merge($data, $this->data); // merge with parent data

        $html = $this->renderer->render('partials/group', $data);
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
