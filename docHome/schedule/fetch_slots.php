<?php
session_start();
require_once '../../Account/conn.php';

if (!isset($_SESSION['doctor_id'])) {
    die(json_encode(['error' => 'Not authorized']));
}

$doctor_id = $_SESSION['doctor_id'];
$sql = "SELECT * FROM doctor_schedule WHERE doctor_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $doctor_id);
$stmt->execute();
$result = $stmt->get_result();

$events = [];
while ($row = $result->fetch_assoc()) {
    $events[] = [
        'id' => $row['id'],
        'title' => 'Available',
        'start' => $row['start_time'],
        'end' => $row['end_time'],
        'status' => $row['status']
    ];
}

echo json_encode($events);