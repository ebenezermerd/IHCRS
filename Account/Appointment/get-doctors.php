<?php
include 'App_classes/databaseConnection.php';
include 'App_classes/doctorFetch.php';

// Create database connection
$dbConnection = new DatabaseConnection("localhost", "root", "", "ihcrs_database");
$conn = $dbConnection->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $doctorFetcher = new DoctorFetcher($conn);

    // selected specialty from the AJAX request
    $selectedSpecialty = $_POST["Speciality"];

    $doctors = $doctorFetcher->fetchDoctors($selectedSpecialty);

    // Return the doctors as JSON response
    echo $doctors;
}

// Close the database connection
$dbConnection->closeConnection();
?>
