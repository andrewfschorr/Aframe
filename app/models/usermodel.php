<?php 

namespace Aframe\Models;

class Usermodel extends DB
{
    public function __construct($db_host, $db_user, $db_pass, $db)
    {
        parent::__construct($db_host, $db_user, $db_pass, $db);
    }

    public function make_user($email, $password)
    {
        return $this->connection->query("INSERT INTO users (`email`, `password`) VALUES ('$email', '$password')");
    }

    public function check_used_email($email)
    {
        return $this->connection->query("SELECT * FROM users WHERE email = '$email'");
    }
}
