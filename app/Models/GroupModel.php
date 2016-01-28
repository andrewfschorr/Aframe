<?php

namespace Aframe\Models;

class GroupModel extends Db
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_groups()
    {
        $groups = array();
        $result = $this->connection->query("SELECT * FROM groups");
        if ($this->connection->error) {
            return false;
        } else {
            while($row = $result->fetch_assoc())
            {
                $groups[] = array(
                    'group' => $row['group'],
                    'count' => $row['count'],
                );
            }
            $result->free();
            return $groups;
        }
    }

    public function add_group($group)
    {
        $query = $this->connection->prepare("INSERT INTO groups (`group`) VALUES (?)");
        $query->bind_param('s', $group);
        return $query->execute();
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
        return ($result->num_rows > 0) ? true : false;
    }
}
