<?php 

session_start();

// Check if the user is not authenticated
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Redirect to the login page
    header("Location: ../account/acc.php");
    exit();
}

?>