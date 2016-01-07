<?php

namespace Aframe\Models;

class Task extends DB
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_tasks()
    {
        $tasks = array();
        $result = $this->connection->query("SELECT * FROM tasks");
        while($row = $result->fetch_assoc())
        {
            $tasks[] = array(
                'id'   => $row['id'],
                'task' => $row['task'],
                'date' => $row['date'],
                'time' => $row['time'],
            );
        }
        $result->free();
        $this->connection->close();
        return $tasks;
    }

    public function add_task($image_params){
        error_log(print_r($image_params, true));
        //$time = date('h:i:s');
        // $date = date('Y-m-d');
        // $query = "INSERT INTO tasks (`task`, `date`, `time`) VALUES ('$task', '$date', '$time')";
        // $this->connection->query($query);
    }

    public function delete_task($task_id)
    {
        $query = "DELETE FROM tasks WHERE id='$task_id'";
        $this->connection->query($query);
    }
}

// function upload(){
// /*** check if a file was uploaded ***/
// if(is_uploaded_file($_FILES['userfile']['tmp_name']) && getimagesize($_FILES['userfile']['tmp_name']) != false)
//     {
//     /***  get the image info. ***/
//     $size = getimagesize($_FILES['userfile']['tmp_name']);
//     /*** assign our variables ***/
//     $type = $size['mime'];
//     $imgfp = fopen($_FILES['userfile']['tmp_name'], 'rb');
//     $size = $size[3];
//     $name = $_FILES['userfile']['name'];
//     $maxsize = 99999999;


//     /***  check the file is less than the maximum file size ***/
//     if($_FILES['userfile']['size'] < $maxsize )
//         {
//         /*** connect to db ***/
//         $dbh = new PDO("mysql:host=localhost;dbname=testblob", 'username', 'password');

//                 /*** set the error mode ***/
//                 $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//             /*** our sql query ***/
//         $stmt = $dbh->prepare("INSERT INTO testblob (image_type ,image, image_size, image_name) VALUES (? ,?, ?, ?)");

//         /*** bind the params ***/
//         $stmt->bindParam(1, $type);
//         $stmt->bindParam(2, $imgfp, PDO::PARAM_LOB);
//         $stmt->bindParam(3, $size);
//         $stmt->bindParam(4, $name);

//         /*** execute the query ***/
//         $stmt->execute();
//         }
//     else
//         {
//         /*** throw an exception is image is not of type ***/
//         throw new Exception("File Size Error");
//         }
//     }
// else
//     {
//     // if the file is not less than the maximum allowed, print an error
//     throw new Exception("Unsupported Image Format!");
//     }
// }
