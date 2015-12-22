<?php 

namespace Aframe\Models;

class Task extends DB
{
    public function __construct($db_host, $db_user, $db_pass, $db)
    {
        parent::__construct($db_host, $db_user, $db_pass, $db);
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

    public function add_task($task){
        $time = date('h:i:s');
        $date = date('Y-m-d');
        $query = "INSERT INTO tasks (`task`, `date`, `time`) VALUES ('$task', '$date', '$time')";
        $this->connection->query($query);
    }

    public function delete_task($task_id)
    {
        $query = "DELETE FROM tasks WHERE id='$task_id'";
        $this->connection->query($query);
    }
}
