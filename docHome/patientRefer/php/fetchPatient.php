<?php
// Database connection class
class DatabaseConnection
{
    private $servername;
    private $username;
    private $password;
    private $dbname;
    private $conn;

    public function __construct($servername, $username, $password, $dbname)
    {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
    }

    public function connect()
    {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        // Check the connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function close()
    {
        if ($this->conn) {
            $this->conn->close();
        }
    }

    public function fetchPatientData($patientId)
    {
        $query = "SELECT * FROM patient WHERE patient_id = '$patientId' ";
        $result = $this->conn->query($query);
        

        // Check if the query was executed successfully
        if ($result !== false && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        }

        return null;
    }
}

// Usage example
if (isset($_GET["patient_id"])) {
    $patientId = $_GET["patient_id"];

    // Create a new instance of the DatabaseConnection class
    $dbConnection = new DatabaseConnection("localhost", "root", "", "ihcrs_database");

    // Connect to the database
    $dbConnection->connect();

    // Fetch the patient data
    $patientData = $dbConnection->fetchPatientData($patientId);

    // Close the database connection
    $dbConnection->close();
}
?>