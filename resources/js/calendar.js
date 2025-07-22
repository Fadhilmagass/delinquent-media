
import tippy from 'tippy.js';
import 'tippy.js/dist/tippy.css';

document.addEventListener('alpine:init', () => {
    Alpine.data('calendar', () => ({
        calendar: null,
        init() {
            const events = this.$wire.get('eventsForCalendar');
            const calendarEl = this.$refs.calendar;

            this.calendar = new FullCalendar.Calendar(calendarEl, {
                height: 'auto',
                aspectRatio: 1.75,
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek'
                },
                events: events,
                eventClick: function(info) {
                    info.jsEvent.preventDefault();
                    if (info.event.url) {
                        window.open(info.event.url, '_blank');
                    }
                },
                eventDidMount: function(info) {
                    tippy(info.el, {
                        content: `
                            <div class="p-2 text-left">
                                <p class="font-bold">${info.event.title}</p>
                                <p class="text-sm">${info.event.extendedProps.venue}, ${info.event.extendedProps.city}</p>
                                <hr class="my-1">
                                <p class="text-xs"><b>Bands:</b> ${info.event.extendedProps.bands || 'N/A'}</p>
                            </div>
                        `,
                        allowHTML: true,
                        theme: 'dark-border',
                        placement: 'top',
                        animation: 'shift-away',
                    });
                },
                eventColor: '#DC2626',
                eventTextColor: '#FFFFFF',
                eventBorderColor: '#991B1B',
            });

            this.calendar.render();

            this.$wire.on('eventsUpdated', (updatedEvents) => {
                this.calendar.removeAllEvents();
                this.calendar.addEventSource(updatedEvents);
            });
        }
    }));
});
