<?php
require_once "class.php";
class search_patient extends DB_con
{
    public function fetchonrecord($tablename, $fullname,$col = "full_name")
    {
        $sql = "SELECT * FROM $tablename WHERE `$col` LIKE '%$fullname%';";
        $result = $this->db_conn->query($sql);

        if ($result)
            return $result;
        else
            return null;
    }
    
}
$search = new search_patient();
?>