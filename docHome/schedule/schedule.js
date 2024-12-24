document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');
    const modalEl = document.getElementById('addSlotModal');
    const addSlotBtn = document.getElementById('addSlotBtn');
    const cancelBtn = document.getElementById('cancelSlot');
    const closeBtn = document.getElementById('closeModal');
    const form = document.getElementById('addSlotForm');
    const availableSlotsDiv = document.getElementById('availableSlots');

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
        },
        eventDidMount: function(info) {
            updateAvailableSlotsList();
        }
    });

    calendar.render();

    // Function to update available slots list
    function updateAvailableSlotsList() {
        fetch('fetch_slots.php')
            .then(response => response.json())
            .then(events => {
                availableSlotsDiv.innerHTML = ''; // Clear existing slots
                
                if (events.length === 0) {
                    availableSlotsDiv.innerHTML = '<p class="text-gray-500">No available time slots</p>';
                    return;
                }

                events.sort((a, b) => new Date(a.start) - new Date(b.start));
                
                events.forEach(event => {
                    const startTime = new Date(event.start);
                    const endTime = new Date(event.end);
                    
                    const slotElement = document.createElement('div');
                    slotElement.className = 'bg-sky-50 p-3 rounded-lg border border-sky-100';
                    slotElement.innerHTML = `
                        <div class="flex justify-between items-center">
                            <div>
                                <div class="font-semibold text-sky-900">
                                    ${startTime.toLocaleDateString()}
                                </div>
                                <div class="text-sky-600">
                                    ${startTime.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})} - 
                                    ${endTime.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}
                                </div>
                            </div>
                            <button onclick="deleteTimeSlot('${event.id}')" class="text-red-500 hover:text-red-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    `;
                    availableSlotsDiv.appendChild(slotElement);
                });
            })
            .catch(error => {
                console.error('Error fetching slots:', error);
                availableSlotsDiv.innerHTML = '<p class="text-red-500">Error loading available slots</p>';
            });
    }

    // Add global function for delete
    window.deleteTimeSlot = function(id) {
        if (confirm('Are you sure you want to delete this time slot?')) {
            fetch('delete_slot.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ id: id })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    calendar.refetchEvents();
                    updateAvailableSlotsList();
                } else {
                    alert(data.message || 'Error deleting time slot');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error deleting time slot');
            });
        }
    }

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
                updateAvailableSlotsList();
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

    // Initial load of available slots
    updateAvailableSlotsList();

    // View switching
    document.getElementById('monthView').addEventListener('click', () => calendar.changeView('dayGridMonth'));
    document.getElementById('weekView').addEventListener('click', () => calendar.changeView('timeGridWeek'));
    document.getElementById('dayView').addEventListener('click', () => calendar.changeView('timeGridDay'));
});