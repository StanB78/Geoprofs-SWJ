// npm install @fullcalendar/react @fullcalendar/daygrid @fullcalendar/timegrid @fullcalendar/interaction
import React, { useState } from 'react';
import ReactDOM from 'react-dom/client';
import FullCalendar from '@fullcalendar/react';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';

export default function JanuaryAgenda() {
    const [events] = useState([
        { title: 'Alice: 9am-17pm', start: '2025-01-03T09:00:00', end: '2025-01-03T17:00:00', color: '#3498db' },
        { title: 'Bob: 10am-11am', start: '2025-01-03T10:00:00', end: '2025-01-03T11:00:00', color: '#e67e22' },
        { title: 'Charlie: 8am-12pm', start: '2025-01-04T08:00:00', end: '2025-01-04T12:00:00', color: '#2ecc71' },
        { title: 'Alice: 13pm-18pm', start: '2025-01-05T13:00:00', end: '2025-01-05T18:00:00', color: '#3498db' },
        { title: 'Bob: 9am-12pm', start: '2025-01-06T09:00:00', end: '2025-01-06T12:00:00', color: '#e67e22' },
    ]);

    return (
        <div style={{ height: '90vh' }}> {/* 90% of viewport height */}
            <FullCalendar
                plugins={[dayGridPlugin, timeGridPlugin, interactionPlugin]}
                initialView="dayGridMonth"
                initialDate="2025-01-01"
                firstDay={1}
                slotMinTime="06:00:00"
                slotMaxTime="20:00:00"
                height="100%"   // Fill parent div (90vh)
                headerToolbar={{
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                }}
                events={events}
                eventDisplay="block"   // ensures color fills day cell
                selectable={true}
                editable={true}
                eventClick={(info) => alert(`Event: ${info.event.title}`)}
            />
        </div>
    );
}

// Mount the React component
const root = ReactDOM.createRoot(document.getElementById('react-calendar'));
root.render(<JanuaryAgenda />);
