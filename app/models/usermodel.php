<?php 

namespace Aframe\Models;

use ErrorException;

class Usermodel extends DB
{
    public function __construct($db_host, $db_user, $db_pass, $db)
    {
        error_log('constructiin!');
        parent::__construct($db_host, $db_user, $db_pass, $db);
    }

    public function make_user($email, $password)
    {
        $mysqli_query = "INSERT INTO users (`email`, `password`) VALUES ('$email', '$password')";
        mysqli_query($this->connection, $mysqli_query);
        
        // var_dump(mysqli_error($this->connection));
        // echo("\n------\n");
        if (mysqli_errno($this->connection)) {
            echo 'we fucked';
            var_dump(mysqli_error($this->connection));
        }

        // if (mysqli_error($this->connection)) {
        //     return mysqli_error($this->connection);
        // }
        // var_dump(mysqli_error($this->connection));
        // try {
        //     error_log('trying!');
        //     $result = mysqli_query($this->connection, $mysqli_query);    
        // } catch (Exception $e) {
        //     return $e;
        // }

        // return $result;
    }
}
