document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');
    const modalEl = document.getElementById('addSlotModal');
    const addSlotBtn = document.getElementById('addSlotBtn');
    const cancelBtn = document.getElementById('cancelSlot');
    const closeBtn = document.getElementById('closeModal');
    const form = document.getElementById('addSlotForm');

    if (!calendarEl) {
        console.error('Calendar element not found');
        return;
    }

    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'timeGridWeek',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        slotMinTime: '08:00:00',
        slotMaxTime: '20:00:00',
        allDaySlot: false,
        selectable: true,
        selectMirror: true,
        events: 'fetch_slots.php',
        dateClick: function(info) {
            // Handle date click
            const date = info.dateStr.split('T')[0];
            document.querySelector('input[name="date"]').value = date;
            modalEl.classList.remove('hidden');
        },
        select: function(info) {
            // Handle time slot selection
            const startTime = info.start;
            const endTime = info.end;
            
            document.querySelector('input[name="date"]').value = startTime.toISOString().split('T')[0];
            document.querySelector('input[name="start_time"]').value = startTime.toTimeString().slice(0,5);
            document.querySelector('input[name="end_time"]').value = endTime.toTimeString().slice(0,5);
            
            modalEl.classList.remove('hidden');
        }
    });

    calendar.render();

    // Basic modal handling
    function closeModal() {
        modalEl.classList.add('hidden');
        form.reset();
    }

    // Event listeners
    addSlotBtn.addEventListener('click', () => modalEl.classList.remove('hidden'));
    cancelBtn.addEventListener('click', closeModal);
    closeBtn.addEventListener('click', closeModal);

    // Form submission
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        try {
            const response = await fetch('save_slot.php', {
                method: 'POST',
                body: new FormData(form)
            });
            const data = await response.json();
            if (data.success) {
                calendar.refetchEvents();
                closeModal();
                alert('Time slot added successfully');
            } else {
                alert(data.message || 'Error saving time slot');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Error saving time slot');
        }
    });

    // View switching
    document.getElementById('monthView').addEventListener('click', () => calendar.changeView('dayGridMonth'));
    document.getElementById('weekView').addEventListener('click', () => calendar.changeView('timeGridWeek'));
    document.getElementById('dayView').addEventListener('click', () => calendar.changeView('timeGridDay'));
});