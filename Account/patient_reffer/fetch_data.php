<?php
include '../../useracc/php/sessioncheck.php';
// Database connection code
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ihcrs_database";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get the patient_id from the AJAX request
$patientId = $_SESSION['patient_id'];

// Query the patient_refferal table to fetch the data based on patient_id
$sql = "SELECT * FROM patient_referral WHERE patient_id = '$patientId' ";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
  // Data found, fetch the row as an associative array
  $data = $result->fetch_assoc();

  // Prepare the response data
  $response = array(
    'status' => 'success',
    'data' => $data
  );
} else {
  // No data found
  $response = array(
    'status' => 'error',
    'message' => 'No data found'
  );
}

// Close the database connection
$conn->close();

// Return the response as JSON
header('Content-Type: application/json');
//echo json_encode($response);
?>
