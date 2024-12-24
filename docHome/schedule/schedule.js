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

    // Initialize draggable templates
    var containerEl = document.getElementById('external-events');
    new FullCalendar.Draggable(containerEl, {
        itemSelector: '.fc-event',
        eventData: function(eventEl) {
            const duration = eventEl.dataset.duration || '01:00';
            return {
                title: 'Available',
                duration: duration,
                backgroundColor: '#0ea5e9',
                textColor: '#ffffff',
                extendedProps: {
                    status: 'available'
                }
            };
        }
    });

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
        editable: true, // Enable drag-and-drop for existing events
        droppable: true, // Allow external drops
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
        },
        eventDrop: function(info) {
            // Handle event drag
            updateSlot(info.event);
        },
        drop: function(info) {
            const startTime = info.date;
            const duration = info.draggedEl.dataset.duration || '01:00';
            const [hours, minutes] = duration.split(':');
            const endTime = new Date(startTime.getTime() + (hours * 60 + Number(minutes)) * 60000);

            const formData = new FormData();
            formData.append('date', startTime.toISOString().split('T')[0]);
            formData.append('start_time', startTime.toTimeString().slice(0,5));
            formData.append('end_time', endTime.toTimeString().slice(0,5));

            fetch('save_slot.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    calendar.refetchEvents();
                    updateAvailableSlotsList();
                } else {
                    alert(data.message || 'Error saving time slot');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error saving time slot');
            });
        },
        eventReceive: function(info) {
            // This handles the dropped event appearance
            info.event.setProp('title', 'Available');
            info.event.setProp('backgroundColor', '#0ea5e9');
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

    function updateSlot(event) {
        const startTime = event.start;
        const endTime = event.end;

        fetch('update_slot.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                id: event.id,
                start: startTime.toISOString(),
                end: endTime.toISOString()
            })
        })
        .then(response => response.json())
        .then(data => {
            if (!data.success) {
                alert(data.message || 'Failed to update time slot');
                event.revert();
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error updating time slot');
            event.revert();
        });
    }

    function saveSlot(slotData) {
        fetch('save_slot.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(slotData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                calendar.refetchEvents();
                updateAvailableSlotsList();
            } else {
                alert(data.message || 'Error saving time slot');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error saving time slot');
        });
    }
});