<?php

namespace Aframe\Controllers;

use Http\Request;
use Http\Response;
use Aframe\Template\FrontendRenderer;
use Aframe\Models\ImageModel;
use Aframe\Utils\Util;

class Image extends Auth_user
{
    protected $request;
    protected $response;
    protected $renderer;

    public function __construct(Request $request, Response $response, FrontendRenderer $renderer)
    {
        parent::__construct($request, $response, $renderer);
        $this->image_model = new ImageModel();
    }

    public function add_image()
    {
        $file_array = $this->request->getFiles();
        $parameters_array = $this->request->getParameters();

        // if theres an image set
        if ( $file_array['image-file']['size'] ){
            if (!is_uploaded_file($file_array['image-file']['tmp_name']) || !getimagesize($file_array['image-file']['tmp_name']) || $file_array['image-file']['error']) {
                Util::set_session('error_msg', 'there was an error with the image');
            }
        }

        if (!$parameters_array['title']) {
            Util::set_session('error_msg', 'You didn\'t give a title and image!');
        } else {
            $img = $this->image_model->add_image(array_merge($file_array, $parameters_array));
        }
        Util::redirect_and_exit($this->request->getReferer());
    }

    public function delete_image()
    {
        $image_id = $this->request->getParameter('id', $defaultValue = null);
        $this->image_model->delete_image($image_id);
    }
}
