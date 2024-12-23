<?php
// Database connection variables
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ihcrs_database";

class PatientSearch {
    private $conn;

    public function __construct($servername, $username, $password, $dbname) {
        // Create a new database connection
        $this->conn = new mysqli($servername, $username, $password, $dbname);

        // Check the connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function searchPatient($patientId) {
        $sql = "SELECT * FROM patient WHERE patient_id = $patientId";
        $result = $this->conn->query($sql);
        return $result;
    }
}
$patientSearch = new PatientSearch($servername, $username, $password, $dbname);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the patient ID from the form
    $patientId = $_POST["patient_id"];

    // Perform the patient search
    $result = $patientSearch->searchPatient($patientId);

    if ($result !== false) {
    // Check if any results were found
    if ($result->num_rows > 0) {
        // Loop through the results and store them in an arra
          while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["full_name"] . "</td>";
            echo "<td>" . $row["age"] . "</td>";
            echo "<td>" . $row["location"]. "</td>";
            echo "<td>" . $row["region"]. "</td>";
            echo "<td>" . $row["phone"]. "</td>";
            echo "<td>" . "<a href='../patientRefer/index.php?patient_id=" . $row["patient_id"] . "'>fill</a>" . "</td>";

            echo "</tr>";
          }
        } else {
            echo "<tr><td colspan='6'>No results found</td></tr>";
          }
        } else {
          echo "Error executing the query: " ;
        }
      
        // Close the database connection
      }
    ?>
   
