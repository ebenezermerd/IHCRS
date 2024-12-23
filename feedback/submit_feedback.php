<?php
session_start();
require_once '../Account/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $patient_id = $_POST['patient_id'];
    $doctor_id = $_POST['doctor_id'];
    $rating = $_POST['rating'];
    $feedback = $_POST['feedback'];

    $stmt = $conn->prepare("INSERT INTO patient_feedback (patient_id, doctor_id, rating, feedback) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siis", $patient_id, $doctor_id, $rating, $feedback);
    
    if ($stmt->execute()) {
        $_SESSION['success'] = "Thank you for your feedback!";
        header("Location: feedback_form.php");
    } else {
        $_SESSION['error'] = "Error submitting feedback: " . $conn->error;
        header("Location: feedback_form.php");
    }
    $stmt->close();
}
?>