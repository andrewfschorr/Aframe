<?php

namespace Aframe\Models;

class TaskModel extends DB
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_tasks()
    {
        $tasks = array();
        $result = $this->connection->query("SELECT * FROM images");
        while($row = $result->fetch_assoc())
        {
            $tasks[] = array(
                'id'   => $row['id'],
                'title' => $row['title'],
                'location' => $row['location'],
                'file_location' => $row['file_location'],
                'file_name' => $row['file_name'],
                'time' => $row['time'],
                'date' => $row['date'],
            );
        }

        $result->free();
        $this->connection->close();
        return $tasks;
    }

    public function add_task($image_params){
        $title = $image_params['title'];
        $location = $image_params['location'];
        $file_name = $image_params['image-file']['name'];

        if ($image_params['image-file']['size']) {
            $uploaded_image_location = ROOT . "/public/assets/img/uploaded_images/$file_name";
            move_uploaded_file($image_params['image-file']['tmp_name'], $uploaded_image_location);
        } else {
            $uploaded_image_location = null;
        }

        $time = date('h:i:s');
        $date = date('Y-m-d');
        $query = "INSERT INTO images (`title`, `location`, `file_location`, `file_name`, `date`, `time`) VALUES ('$title', '$location', '$uploaded_image_location', '$file_name', '$date', '$time')";
        $this->connection->query($query);
    }

    public function delete_task($image_id)
    {
        $query = "DELETE FROM images WHERE id='$image_id'";
        $this->connection->query($query);
    }
}
