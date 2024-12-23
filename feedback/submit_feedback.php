<?php
session_start();
require_once '../Account/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate required fields
    if (empty($_POST['patient_id']) || empty($_POST['doctor_id']) || empty($_POST['rating']) || empty($_POST['feedback'])) {
        $_SESSION['error'] = "All fields are required";
        header("Location: feedback_form.php");
        exit();
    }

    $patient_id = intval($_POST['patient_id']);
    $doctor_id = intval($_POST['doctor_id']);
    $rating = intval($_POST['rating']);
    $feedback = htmlspecialchars($_POST['feedback']);
    
    // Validate doctor exists
    $doctor_check = $conn->prepare("SELECT id FROM doctors WHERE id = ?");
    $doctor_check->bind_param("i", $doctor_id);
    $doctor_check->execute();
    if (!$doctor_check->get_result()->num_rows) {
        $_SESSION['error'] = "Invalid doctor selected";
        header("Location: feedback_form.php");
        exit();
    }

    // Insert feedback with doctor_id
    $stmt = $conn->prepare("INSERT INTO patient_feedback (patient_id, doctor_id, rating, feedback, created_at) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param("iiis", $patient_id, $doctor_id, $rating, $feedback);
    
    if ($stmt->execute()) {
        $_SESSION['success'] = "Thank you for your feedback!";
    } else {
        $_SESSION['error'] = "Error submitting feedback: " . $conn->error;
    }
    
    $stmt->close();
    header("Location: feedback_form.php");
    exit();
}
?>