<?php
session_start();
require_once '../../Account/conn.php';

if (!isset($_SESSION['doctor_id'])) {
    die(json_encode(['success' => false, 'message' => 'Not authorized']));
}

if (!isset($_POST['date']) || !isset($_POST['start_time']) || !isset($_POST['end_time'])) {
    die(json_encode(['success' => false, 'message' => 'Missing required fields']));
}

$doctor_id = $_SESSION['doctor_id'];
$date = $_POST['date'];
$start_time = $date . ' ' . $_POST['start_time'];
$end_time = $date . ' ' . $_POST['end_time'];

// Validate times
if (strtotime($end_time) <= strtotime($start_time)) {
    die(json_encode(['success' => false, 'message' => 'End time must be after start time']));
}

// Check for overlapping slots
$check_sql = "SELECT id FROM doctor_schedule 
              WHERE doctor_id = ? 
              AND ((start_time < ? AND end_time > ?) 
              OR (start_time < ? AND end_time > ?) 
              OR (start_time >= ? AND end_time <= ?))";
              
$check_stmt = $conn->prepare($check_sql);
$check_stmt->bind_param("issssss", $doctor_id, $end_time, $start_time, $end_time, $start_time, $start_time, $end_time);
$check_stmt->execute();

if ($check_stmt->get_result()->num_rows > 0) {
    die(json_encode(['success' => false, 'message' => 'Time slot overlaps with existing appointment']));
}

// Insert new slot
$sql = "INSERT INTO doctor_schedule (doctor_id, start_time, end_time, status) VALUES (?, ?, ?, 'available')";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iss", $doctor_id, $start_time, $end_time);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Time slot created successfully']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error creating time slot']);
}