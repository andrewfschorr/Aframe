<?php

namespace Aframe\Models;

class GroupModel extends DB
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_groups()
    {
        $pages = array();
        $result = $this->connection->query("SELECT * FROM groups");
        while($row = $result->fetch_assoc())
        {
            $pages[] = $row['group'];
        }

        $result->free();
        return $pages;
    }

    public function add_group($group)
    {
        $query = "INSERT INTO groups (`group`) VALUES ('$group')";
        return $this->connection->query($query);
    }
}
