<?php
session_start();
require_once '../conn.php';

if (!isset($_SESSION['patient_id'])) {
    die(json_encode(['success' => false, 'message' => 'Please login first']));
}

$input = json_decode(file_get_contents('php://input'), true);
$doctor_id = $input['doctor_id'];
$slot_id = $input['slot_id'];
$patient_id = $_SESSION['patient_id'];

// Start transaction
$conn->begin_transaction();

try {
    // Check if slot is still available
    $check_sql = "SELECT status FROM doctor_schedule WHERE id = ? AND status = 'available' FOR UPDATE";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("i", $slot_id);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    if ($result->num_rows === 0) {
        throw new Exception('Time slot no longer available');
    }

    // Update slot status
    $update_sql = "UPDATE doctor_schedule SET status = 'booked' WHERE id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("i", $slot_id);
    $update_stmt->execute();

    // Create appointment record
    $appt_sql = "INSERT INTO appointment_book (patient_id, doctor_id, appointment_date, appointment_time, status) 
                 VALUES (?, ?, ?, ?, 'PENDING')";
    $appt_stmt = $conn->prepare($appt_sql);
    $appt_stmt->bind_param("iiss", $patient_id, $doctor_id, $input['start_time'], $input['end_time']);
    $appt_stmt->execute();

    $conn->commit();
    echo json_encode(['success' => true]);
} catch (Exception $e) {
    $conn->rollback();
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}