<?php
session_start();
require_once '../conn.php';

if (!isset($_GET['doctor_id'])) {
    header("Location: appoint.php");
    exit();
}

$doctor_id = $_GET['doctor_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Schedule - IHCRS</title>
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
</head>
<body class="bg-gray-50">
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div id="calendar"></div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'timeGridWeek',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            slotMinTime: '08:00:00',
            slotMaxTime: '20:00:00',
            allDaySlot: false,
            events: 'fetch_doctor_slots.php?doctor_id=<?php echo $doctor_id; ?>',
            eventClick: function(info) {
                if (info.event.extendedProps.status === 'available') {
                    if (confirm('Would you like to book this time slot?')) {
                        bookAppointment(info.event);
                    }
                }
            }
        });
        calendar.render();
    });

    function bookAppointment(event) {
        const data = {
            doctor_id: <?php echo $doctor_id; ?>,
            start_time: event.start.toISOString(),
            end_time: event.end.toISOString(),
            slot_id: event.id
        };

        fetch('book_appointment.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Appointment booked successfully!');
                calendar.refetchEvents();
            } else {
                alert(data.message || 'Error booking appointment');
            }
        });
    }
    </script>
</body>
</html>