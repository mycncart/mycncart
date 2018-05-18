$(document).ready(function() {

	/* initialize the external events
	-----------------------------------------------------------------*/

	$('#external-events .fc-event').each(function() {

		// store data so the calendar knows to render an event upon drop
		$(this).data('event', {
			title: $.trim($(this).text()), // use the element's text as the event title
			stick: true // maintain when user navigates (see docs on the renderEvent method)
		});

		// make the event draggable using jQuery UI
		$(this).draggable({
			zIndex: 999,
			revert: true,      // will cause the event to go back to its
			revertDuration: 0  //  original position after the drag
		});

	});

	/* initialize the calendar
	-----------------------------------------------------------------*/

	$('#calendar').fullCalendar({
		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,agendaWeek,agendaDay'
		},
		editable: true,
		eventLimit: true, // allow "more" link when too many events
		events: [
			{
				title: 'All Day Event',
				start: '2016-11-01'
			},
			{
				title: 'Long Event',
				start: '2016-11-07',
				end: '2016-11-10'
			},
			{
				id: 999,
				title: 'Repeating Event',
				start: '2016-11-09T16:00:00'
			},
			{
				id: 999,
				title: 'Repeating Event',
				start: '2016-11-16T16:00:00'
			},
			{
				title: 'Conference',
				start: '2016-11-11',
				end: '2016-11-13'
			},
			{
				title: 'Meeting',
				start: '2016-11-12T10:30:00',
				end: '2016-11-12T12:30:00'
			},
			{
				title: 'Lunch',
				start: '2016-11-12T12:00:00'
			},
			{
				title: 'Meeting',
				start: '2016-11-12T14:30:00'
			},
			{
				title: 'Happy Hour',
				start: '2016-11-12T17:30:00'
			},
			{
				title: 'Dinner',
				start: '2016-11-12T20:00:00'
			},
			{
				title: 'Birthday Party',
				start: '2016-11-13T07:00:00'
			},
			{
				title: 'Click for Google',
				url: 'http://google.com/',
				start: '2016-11-28'
			}
		],
		droppable: true, // this allows things to be dropped onto the calendar
		drop: function() {
			// is the "remove after drop" checkbox checked?
			if ($('#drop-remove').is(':checked')) {
				// if so, remove the element from the "Draggable Events" list
				$(this).remove();
			}
		}
	});

});