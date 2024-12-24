<?php
session_start();
require_once '../../Account/conn.php';

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
    <title>Doctor Schedule Management - IHCRS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: 'rgba(15, 151, 155, 0.804)',
                        secondary: '#E0F2FE',
                    }
                }
            }
        }
    </script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
    <link rel="stylesheet" href="schedule.css">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;700&family=Rubik:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-50 font-['Rubik']">
    <!-- Header -->
    <header class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <a href="../../index.php" class="flex items-center">
                    <img src="../../logo.png" width="180" height="36" alt="IHCRS">
                </a>
                <nav class="flex items-center space-x-8">
                    <a href="../index.php" class="text-gray-600 hover:text-primary transition-colors">&larr; Back to Dashboard</a>
                    <a href="../../Account/logout.php" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">Logout</a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <div class="bg-gradient-to-b from-primary/10 to-white rounded-lg p-6 mb-8">
            <h1 class="text-3xl font-bold text-primary mb-2">Schedule Management</h1>
            <p class="text-gray-600">Manage your available time slots and appointments</p>
        </div>

        <div class="flex justify-end space-x-4 mb-6">
            <button id="monthView" class="bg-secondary text-primary px-4 py-2 rounded-lg hover:bg-primary hover:text-white transition-colors">Month</button>
            <button id="weekView" class="bg-secondary text-primary px-4 py-2 rounded-lg hover:bg-primary hover:text-white transition-colors">Week</button>
            <button id="dayView" class="bg-secondary text-primary px-4 py-2 rounded-lg hover:bg-primary hover:text-white transition-colors">Day</button>
            <button id="addSlotBtn" class="bg-primary text-white px-6 py-2 rounded-lg hover:bg-primary/80 transition-colors">Add Time Slot</button>
        </div>

        <div class="grid md:grid-cols-12 gap-6">
            <!-- Calendar Section -->
            <div class="md:col-span-8">
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <div id="calendar"></div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="md:col-span-4 space-y-6">
                <!-- Templates Section -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h2 class="text-xl font-semibold mb-4 text-primary">Time Slot Templates</h2>
                    <div id="external-events" class="space-y-3">
                        <div class="fc-event bg-secondary p-3 rounded-lg cursor-move border-l-4 border-primary" data-duration="01:00">
                            <p class="font-semibold text-primary">1 Hour Slot</p>
                            <p class="text-sm text-gray-600">Drag to calendar</p>
                        </div>
                        <div class="fc-event bg-secondary p-3 rounded-lg cursor-move border-l-4 border-primary" data-duration="00:30">
                            <p class="font-semibold text-primary">30 Min Slot</p>
                            <p class="text-sm text-gray-600">Drag to calendar</p>
                        </div>
                    </div>
                </div>

                <!-- Available Slots Section -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h2 class="text-xl font-semibold mb-4 text-primary">Available Time Slots</h2>
                    <div id="availableSlots" class="space-y-3">
                        <!-- Slots will be populated here -->
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal -->
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