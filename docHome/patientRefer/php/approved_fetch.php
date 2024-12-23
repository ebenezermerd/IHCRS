<?php
class approvedFetch {
    private $conn;
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "ihcrs_database";
    private $table = 'patient_referral';

    public function __construct() {
        $this->conn = new mysqli($this->host,$this->username, $this->password, $this->database);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
    public function closeConnection() {
        $this->conn->close();
    }

public function getPatients(){
$query = "SELECT full_name, patient_id FROM $this->table";
    $result = $this->conn->query($query);
    $patients = [];

    if ($result) {
      while ($row = $result->fetch_assoc()) {
        $patients[] = $row;
      }
    }

    $this->conn->close();

    return $patients;
  }
}

?>