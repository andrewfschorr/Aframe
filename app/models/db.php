<?php 

namespace Aframe\Models;

class DB 
{
    public function __construct($db_host, $db_user, $db_pass, $db)
    {
        $this->connection = mysqli_connect($db_host, $db_user, $db_pass, $db);
        if (!$this->connection) die(mysqli_connect_error());
    }

    public function get_tasks()
    {      
        $tasks = array();

        $query = mysqli_query($this->connection, "SELECT * FROM tasks");
        
        while($result = mysqli_fetch_array($query))
        {
            $tasks[] = array(
                'id'   => $result['id'],
                'task' => $result['task'],
                'date' => $result['date'],
                'time' => $result['time'],
            );
        }

        mysqli_close($this->connection);
        return $tasks;
    }

    public function add_task($task){
        $time = date('h:i:s');
        $date = date('Y-m-d');
        $mysqli_query = "INSERT INTO tasks (`task`, `date`, `time`) VALUES ('$task', '$date', '$time')";
        mysqli_query($this->connection, $mysqli_query);
    }

    public function delete_task($task_id)
    {
        error_log($task_id);
        $mysqli_query = "DELETE FROM tasks WHERE id='$task_id'";
        mysqli_query($this->connection, $mysqli_query);
    }
}