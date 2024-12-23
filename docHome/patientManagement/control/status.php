<?php
require_once "class.php";
class status extends DB_con
{
    public function fetchStatus($tablename, $id, $doctor, $date)
    {
        // $this->db_conn = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
        $sql = "SELECT *
        FROM $tablename
        WHERE `id` = $id
          AND `doctor` = '$doctor'
          AND `date` = '$date'
          AND `status` = 'waiting'";
        $sql = "select * from $tablename";
        $result = $this->db_conn->query($sql);

        $re = mysqli_fetch_assoc($result);
        if ($re)
            return $re;
        else
            return null;
    }
    public function update($tablename, $id, $status)
    {
        $sql = "UPDATE $tablename 
        SET `status` = '$status'
        WHERE `id` = $id";
       $R= $this->db_conn->query($sql);
        if ($R === false)
            echo $this->db_conn->error;
    }
}
$S = new status();
if (isset($_GET["status"])&& isset($_GET["id"])) {
   echo $S->update("appointment_book", $_GET["id"], $_GET["status"]);
   
    header("Location: ../appintment.php");
}
?>
