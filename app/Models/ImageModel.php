<?php

namespace Aframe\Models;

class ImageModel extends Db
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
        if ($this->connection->error) {
            return false;
        } else {
            return $this->format_results($result);
        }
    }

    private function format_results($results)
    {
        $images = array();
        if (empty($results)) {
            return $images;
        }

        while($row = $results->fetch_assoc())
        {
            $group = $row['group'];
            $file_name = $row['file_name'];
            $public_fp = "/public/assets/img/uploaded_images/$group/$file_name";

            $images[] = array(
                'id'            => $row['id'],
                'title'         => $row['title'],
                'group'         => $group,
                'location'      => $row['location'],
                'file_location' => $row['file_location'],
                'public_fp'     => $public_fp,
                'file_name'     => $file_name,
                'featured'      => $row['featured'],
                'time'          => $row['time'],
                'date'          => $row['date'],
                'file_name'     => $row['file_name'],
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
                error_log('making new directory at: ' . ROOT . "/public/assets/img/uploaded_images/$group");
                mkdir(ROOT . "/public/assets/img/uploaded_images/$group", 755, true);
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

    public function feature_image($group_name, $id, $featured_status)
    {
        $this->connection->query("UPDATE images SET featured = '$featured_status' WHERE `group`='$group_name' AND `id`= '$id';");
        if ($this->connection->error) {
            error_log($this->connection->error);
            return false;
        } else {
            return true;
        }
    }

    public function get_featured_images()
    {
        $images = $this->connection->query("SELECT * FROM `images` WHERE `featured` = 1");
        if ($this->connection->error) {
            error_log($this->connection->error);
            return false;
        } else {
            return $this->format_results($images);
        }
    }
}
