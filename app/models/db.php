<?php

namespace Aframe\Models;

use Mysqli;

class DB
{
    public function __construct()
    {
        $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB);
        if ($this->connection->connect_errno) {
            throw new ErrorException($mysqli->connect_errno);
        }
    }
}
