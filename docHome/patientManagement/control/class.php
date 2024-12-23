<?php
abstract class DB_con
{
    public $db_host = "localhost";
    public $db_user = "root";
    public $db_pass = "";
    public $db_name = "ihcrs_database";
    public $db_conn;
    public function __construct()
    {
        $this->db_conn = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
        if ($erro = $this->db_conn->connect_error)
            die("<scri>alert('Error when try to connect ')</script> $erro");
        else
            echo '<script>
            console.log("Successfully connected to database");
        </script>';
    }
    public function insert($tablename,$data)
    {
        $columns = implode(',', array_keys($data));
        $values = implode(',', array_map(function ($value) {
           
            return '"' . $this->db_conn->real_escape_string($value ) . '"';
        }, array_values($data)));
        $sql = "INSERT INTO `$tablename` ($columns) VALUES ($values)";

        $result = $this->db_conn->query($sql);
        if ($result) {
            return 1;
        } else {
            echo $this->db_conn->error;
            return 0;
        }


    }
    public function fetchdata($tablename)
    {
        $sql = "SELECT * FROM $tablename";
        $result = $this->db_conn->query($sql);
        if ($result)
            return $result;
        else
            return null;
    }
    public function fetchonrecord($tablename, $id ,$col)
    {
        $sql = "SELECT * FROM $tablename WHERE `$col`= $id";
        $result = $this->db_conn->query($sql);
        $re = mysqli_fetch_assoc($result);
        
        if ($re)
            return $re;
        else
            return null;
    }

   
    public function delete($tablename, $id)
    {
        $sql = "DELETE FROM $tablename WHERE patient_id = $id";
        $result = $this->db_conn->query($sql);
        echo $result;
        if ($result)
            return 1;
        else
            return 0;
    }
    
    public function close()
    {
        $this->db_conn->close();
    }

}
?>