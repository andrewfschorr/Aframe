<?php

namespace Aframe\Models;

class ImageModel extends DB
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_images($group)
    {
        $result = $this->connection->query("SELECT * FROM `images` WHERE `group` = '$group'");
        return $this->format_results($result);
    }

    public function get_all_images()
    {
        $images = array();
        $result = $this->connection->query("SELECT * FROM images");
        return $this->format_results($result);
    }

    private function format_results($results)
    {
        $images = array();
        if (empty($results)) {
            return $images;
        }

        while($row = $results->fetch_assoc())
        {
            $images[] = array(
                'id'   => $row['id'],
                'title' => $row['title'],
                'group' => $row['group'],
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

    public function add_image($image_params){
        $title = $image_params['title'];
        $location = $image_params['location'];
        $file_name = $image_params['image-file']['name'];
        $group = $image_params['group'];

        if ($image_params['image-file']['size']) {
            if(!is_dir(ROOT . "/public/assets/img/uploaded_images/$group")) {
                mkdir(ROOT . "/public/assets/img/uploaded_images/$group");
            }

            $uploaded_image_location = ROOT . "/public/assets/img/uploaded_images/$group/$file_name";

            move_uploaded_file($image_params['image-file']['tmp_name'], $uploaded_image_location);
        } else {
            $uploaded_image_location = null;
        }

        $time = date('h:i:s');
        $date = date('Y-m-d');
        $query = "INSERT INTO images (`title`, `group`, `location`, `file_location`, `file_name`, `date`, `time`) VALUES ('$title', '$group','$location', '$uploaded_image_location', '$file_name', '$date', '$time'); ";
        $query .= "UPDATE `groups` SET `count` = `count` + 1 WHERE `group`='$group';";
        $this->connection->multi_query($query);
        if ($this->connection->error) {
            error_log($this->connection->error);
        }
    }

    public function delete_image($image_id, $group)
    {
        $query = "DELETE FROM images WHERE id='$image_id'; ";
        $query .= "UPDATE `groups` SET `count` = `count` - 1 WHERE `group`='$group';";


        $this->connection->multi_query($query);
        if ($this->connection->error) {
            error_log($this->connection->error);
            return false;
        } else {
            return true;
        }
    }
}
