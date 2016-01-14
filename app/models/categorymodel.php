<?php

namespace Aframe\Models;

class CategoryModel extends DB
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_categories()
    {
        $categories = array();
        $result = $this->connection->query("SELECT * FROM categories");
        while($row = $result->fetch_assoc())
        {
            $categories[] = $row['category'];
        }

        $result->free();
        $this->connection->close();
        return $categories;
    }

    public function add_category($category)
    {
        $query = "INSERT INTO categories (`category`) VALUES ('$category')";

        return $this->connection->query($query);
    }
}
