<?php
session_start();
require_once '../../Account/conn.php';

// Verify doctor is logged in
if (!isset($_SESSION['doctor_id'])) {
    header("Location: ../../Account/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Schedule Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Single bundle import for FullCalendar -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
    <link rel="stylesheet" href="schedule.css">
</head>
<body class="bg-gray-50">
    <div class="container mx-auto px-4 py-8">
        <div class="mb-4">
            <a href="../dashboard.php" class="text-sky-600 hover:text-sky-800">&larr; Back to Dashboard</a>
        </div>
        
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-sky-600">Schedule Management</h1>
            <div class="space-x-4">
                <button id="monthView" class="bg-sky-100 text-sky-600 px-4 py-2 rounded-lg hover:bg-sky-200">Month</button>
                <button id="weekView" class="bg-sky-100 text-sky-600 px-4 py-2 rounded-lg hover:bg-sky-200">Week</button>
                <button id="dayView" class="bg-sky-100 text-sky-600 px-4 py-2 rounded-lg hover:bg-sky-200">Day</button>
                <button id="addSlotBtn" class="bg-sky-600 text-white px-4 py-2 rounded-lg hover:bg-sky-700">Add Time Slot</button>
            </div>
        </div>

        <div class="grid md:grid-cols-12 gap-6">
            <div class="md:col-span-8 bg-white rounded-lg shadow-md p-6">
                <div id="calendar"></div>
            </div>

            <!-- Restore the original sidebar -->
            <div class="md:col-span-4 bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-4 text-sky-600">Available Time Slots</h2>
                <div id="availableSlots" class="space-y-2">
                    <!-- Time slots will be populated here -->
                </div>
            </div>
        </div>

    </div>

    <!-- Update modal structure -->
    <div id="addSlotModal" class="modal-overlay hidden">
        <div class="modal-content">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-sky-600">Add Available Time Slot</h2>
                <button type="button" id="closeModal" class="text-gray-400 hover:text-gray-500">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form id="addSlotForm">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Date</label>
                        <input type="date" name="date" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-sky-300 focus:ring focus:ring-sky-200 focus:ring-opacity-50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Start Time</label>
                        <input type="time" name="start_time" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-sky-300 focus:ring focus:ring-sky-200 focus:ring-opacity-50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">End Time</label>
                        <input type="time" name="end_time" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-sky-300 focus:ring focus:ring-sky-200 focus:ring-opacity-50">
                    </div>
                    <div class="flex justify-end space-x-3 pt-4">
                        <button type="button" id="cancelSlot" class="bg-gray-200 px-4 py-2 rounded-lg hover:bg-gray-300">Cancel</button>
                        <button type="submit" class="bg-sky-600 text-white px-4 py-2 rounded-lg hover:bg-sky-700">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="schedule.js"></script>
</body>
</html>