<?php

namespace Aframe\Models;

class TaskModel extends DB
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_page_tasks($page)
    {
        $result = $this->connection->query("SELECT * FROM images WHERE page='$page'");
        return $this->format_results($result);
    }

    public function get_all_tasks()
    {
        $tasks = array();
        $result = $this->connection->query("SELECT * FROM images");
        return $this->format_results($result);
    }

    private function format_results($results)
    {
        $images = array();
        while($row = $results->fetch_assoc())
        {
            $images[] = array(
                'id'   => $row['id'],
                'title' => $row['title'],
                'page' => $row['page'],
                'location' => $row['location'],
                'file_location' => $row['file_location'],
                'file_name' => $row['file_name'],
                'time' => $row['time'],
                'date' => $row['date'],
            );
        }

        $results->free();
        $this->connection->close();
        return $images;
    }

    public function add_task($image_params){
        $title = $image_params['title'];
        $location = $image_params['location'];
        $file_name = $image_params['image-file']['name'];
        $image_type = $image_params['image_type'];

        if ($image_params['image-file']['size']) {
            error_log(print_r($image_params, true));
            if(!is_dir(ROOT . "/public/assets/img/uploaded_images/$image_type")) {
                mkdir(ROOT . "/public/assets/img/uploaded_images/$image_type");
            }

            $uploaded_image_location = ROOT . "/public/assets/img/uploaded_images/$image_type/$file_name";

            move_uploaded_file($image_params['image-file']['tmp_name'], $uploaded_image_location);
        } else {
            $uploaded_image_location = null;
        }

        $time = date('h:i:s');
        $date = date('Y-m-d');
        $query = "INSERT INTO images (`title`, `page`, `location`, `file_location`, `file_name`, `date`, `time`) VALUES ('$title', '$image_type','$location', '$uploaded_image_location', '$file_name', '$date', '$time')";
        $this->connection->query($query);
    }

    public function delete_task($image_id)
    {
        $query = "DELETE FROM images WHERE id='$image_id'";
        $this->connection->query($query);
    }
}
