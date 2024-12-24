<?php
session_start();
require_once '../../Account/conn.php';

if (!isset($_SESSION['doctor_id'])) {
    die(json_encode(['success' => false, 'message' => 'Not authorized']));
}

$data = json_decode(file_get_contents('php://input'), true);
$slot_id = $data['id'];
$start_time = date('Y-m-d H:i:s', strtotime($data['start']));
$end_time = date('Y-m-d H:i:s', strtotime($data['end']));
$doctor_id = $_SESSION['doctor_id'];

// Verify slot belongs to doctor
$verify_sql = "SELECT id FROM doctor_schedule WHERE id = ? AND doctor_id = ?";
$verify_stmt = $conn->prepare($verify_sql);
$verify_stmt->bind_param("ii", $slot_id, $doctor_id);
$verify_stmt->execute();
if (!$verify_stmt->get_result()->fetch_assoc()) {
    die(json_encode(['success' => false, 'message' => 'Invalid slot']));
}

$sql = "UPDATE doctor_schedule SET start_time = ?, end_time = ? WHERE id = ? AND doctor_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssii", $start_time, $end_time, $slot_id, $doctor_id);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error updating slot']);
}