<?php
require_once "class.php";
class update_patient extends DB_con{
    public function updat($tableName, $data)
    {
        if (empty($data)) {
            echo "Error: Data is empty";
            return 0;
        }
        
        $columns = [];
        foreach ($data as $column => $value) {
            $escapedValue = $this->db_conn->real_escape_string($value);
            $columns[] = "$column='$escapedValue'";
        }
        $columnsString = implode(',', $columns);
        
        $patientId = $this->db_conn->real_escape_string($data["patient_id"]);
        
        $sql = "UPDATE `$tableName` SET $columnsString WHERE patient_id = $patientId";
        
        $result = $this->db_conn->query($sql);
        if ($result) {
            return 1;
        } else {
            echo $this->db_conn->error;
            return 0;
        }
    }
    
}
$udt = new update_patient();
if (isset($_POST["patient_update"])) {
    $name = $_POST['name'];

    $age = $_POST['age'];
    $dob = $_POST['dob'];
    $regLoc = $_POST['location'];

    $city = $_POST['city'];
    $region = $_POST['region'];
    $pnum = $_POST['phone'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $p_id = $_POST["PID"];
    $data = array(
      "patient_id" => $p_id,
      "full_name" => $name,
      "age" => $age,
    
      "birth_date" => $dob,
      "location" => $regLoc,
      "date" => date('d/m/y'),
      "city" => $city,
      "region" => $region,
      "phone" => $pnum,
      "email" => $email,
      "password" => $pass
    );
    if ($udt->update("patient", $data)){ 
        header("Location:../update_patient.php");
    }
    else
      echo "Oops! Something went wrong. Please try again later or contact support for assistance.";
     
  }
  
?>
