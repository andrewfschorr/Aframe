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
        $groups = array();
        $result = $this->connection->query("SELECT * FROM groups");
        while($row = $result->fetch_assoc())
        {
            //$groups[] = $row['group'];
            $groups[] = array(
                'group' => $row['group'],
                'count' => $row['count'],
            );

        }

        $result->free();
        return $groups;
    }

    public function add_group($group)
    {
        $query = "INSERT INTO groups (`group`) VALUES ('$group')";
        return $this->connection->query($query);
    }

    public function delete_group($group)
    {
        $query = "SELECT * FROM `images` WHERE `group` ='$group'";
        $result = $this->connection->query($query);
        if ($result->num_rows > 0) { // if more than 0
            return false;
        } else {
            $query = "DELETE FROM `groups` WHERE `group` ='$group' LIMIT 1";
            $result = $this->connection->query($query);
            return true;
        }
    }

    public function group_exists($group)
    {
        $query = "SELECT * FROM `groups` WHERE `group` ='$group'";
        $result = $this->connection->query($query);
        error_log('fuck');
        error_log(print_r($result, true));
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
}
