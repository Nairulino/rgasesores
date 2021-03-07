document.addEventListener('DOMContentLoaded', function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});
var events = [];
var id_user = "";
var name_user = "";


$.ajax({
    type: 'GET',
    url: "calendar",
    success: function (data) {
        for (i in data) {
            events.push({
                id: data[i].id,
                title: data[i].title,
                start: data[i].start,
                end: data[i].end,
                description: data[i].description,
                name_user: data[i].name_user,
                id_user: data[i].id_user
            });
        }

        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'listWeek',
            locale: 'es',
            firstDay: 1,
            height: 570,
            editable: true,
            selectable: true,
            events: events,
            displayEventTime: true,
            editable: true,
            eventRender: function (event, element, view) {
                if (event.allDay === 'true') {
                    event.allDay = true;
                } else {
                    event.allDay = false;
                }
            },
            selectable: false,
            selectHelper: false,
            eventClick: function (event) {
                $('#infoModal').modal();
                $('#infoModal #modalTitle').html('Información del evento');
                $("#infoModal #deleteEvent").off('click');
                $('#infoModal #title').val(event.event.title);
                $('#infoModal #start').val(moment(event.event.startStr).format('YYYY-MM-DDTHH:mm'));
                $('#infoModal #end').val(moment(event.event.endStr).format('YYYY-MM-DDTHH:mm'));
                $('#infoModal #user').val(event.event._def.extendedProps.name_user);
                $('#infoModal #description').val(event.event._def.extendedProps.description);
                $('#infoModal #saveEvent').off('click');
                $('#infoModal #saveEvent').on('click', function () {
                    var title = $('#infoModal #title').val();
                    var start = $('#infoModal #start').val();
                    var end = $('#infoModal #end').val();
                    var name_user = $('#infoModal #user').val();
                    var description = $('#infoModal #description').val();
                    if (id_user == "")
                        id_user = event.event.extendedProps.id_user;
                    $.ajax({
                        url: 'calendar/edit',
                        type: 'PUT',
                        data: {
                            id: event.event.id,
                            title: title,
                            start: start,
                            end: end,
                            id_user: id_user,
                            name_user: name_user,
                            description: description
                        },
                        success: function (response) {
                            console.log("¡Modificado satisfactoriamente!");
                            var eventModify = calendar.getEventById(event.event.id);
                            eventModify.setProp('title', title);
                            eventModify.setStart(start);
                            eventModify.setEnd(end);
                            eventModify.setExtendedProp('id_user', id_user);
                            eventModify.setExtendedProp('name_user', name_user);
                            eventModify.setExtendedProp('description', description);
                        }
                    });

                    $('#infoModal').modal('hide');
                });
            }
        });

        calendar.setOption('locale', 'es');
        calendar.render();
    }
});
