<?php 

namespace Aframe\Models;

use Mysqli;

class DB 
{
    public function __construct($db_host, $db_user, $db_pass, $db)
    {
        $this->connection = new mysqli($db_host, $db_user, $db_pass, $db);
        if ($this->connection->connect_errno) {
            throw new ErrorException($mysqli->connect_errno);
        }
    }
}