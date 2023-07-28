$(document).ready(function(){

    // Define element
         const calendarBasicViewElement = document.querySelector('.fullcalendar-basic');
        // Initialize
         const calendarBasicViewInit = new FullCalendar.Calendar(calendarBasicViewElement, {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'timeGridWeek,timeGridDay'
                },
                // initialDate: '2020-09-12',
                navLinks: true, // can click day/week names to navigate views
                nowIndicator: true,
                weekNumberCalculation: 'ISO',
                editable: true,
                selectable: true,
                direction: document.dir == 'rtl' ? 'rtl' : 'ltr',
                dayMaxEvents: true, // allow "more" link when too many events
                // events: events

                // dateClick: function(info) {
                //     alert('clicked ' + info.dateStr);
                // },
                select: function(info) {
                    alert('selected ' + info.startStr + ' to ' + info.endStr);
                    //  $('#modal_rooms').modal('show');
                }
            });

            // Init
            calendarBasicViewInit.render();

            // Resize calendar when sidebar toggler is clicked
            document.querySelectorAll('.sidebar-control').forEach(function(sidebarToggle) {
                sidebarToggle.addEventListener('click', function() {
                    calendarBasicViewInit.updateSize();
                });
            });
});