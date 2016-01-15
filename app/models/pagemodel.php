<?php

namespace Aframe\Models;

class PageModel extends DB
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_pages()
    {
        $pages = array();
        $result = $this->connection->query("SELECT * FROM pages");
        while($row = $result->fetch_assoc())
        {
            $pages[] = $row['page'];
        }

        $result->free();
        return $pages;
    }

    public function add_page($page)
    {
        $query = "INSERT INTO pages (`page`) VALUES ('$page')";
        return $this->connection->query($query);
    }
}
