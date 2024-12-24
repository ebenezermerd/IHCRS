<?php
session_start();
require_once '../conn.php';

if (!isset($_GET['doctor_id'])) {
    die(json_encode(['error' => 'Doctor ID required']));
}

$doctor_id = $_GET['doctor_id'];
$sql = "SELECT * FROM doctor_schedule WHERE doctor_id = ? AND status = 'available'";
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
        'backgroundColor' => '#48afc6',
        'status' => $row['status']
    ];
}

echo json_encode($events);