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

$('#editModal #user').on('keypress',function (e) {
    if (e.key === "Enter") {
        var query = $('#editModal #user').val();
        $.ajax({
            url: "search/users",
            type: "GET",
            data: {
                'user': query
            },

            success: function (data) {
                $('#editModal #users_list').html("");
                if(data.users[0] != undefined){
                    name_user = data.users[0].name;
                    id_user = data.users[0].id_user;
                    $('#editModal #user').val(name_user);
                    $('#editModal #id_user').val(id_user);
                }
            }
        });
    }
});

$('#editModal #user').on('input',function (e) {
    var query = $('#editModal #user').val();

    $.ajax({
        url: "search/users",
        type: "GET",
        data: {
            'user': query
        },

        success: function (data) {
            $('#editModal #users_list').html(data.html);
        }
    });
});

$('#calendarModal #user').on('keypress',function (e) {
    if (e.key === "Enter") {
        var query = $('#calendarModal #user').val();
        $.ajax({
            url: "search/users",
            type: "GET",
            data: {
                'user': query
            },

            success: function (data) {
                $('#calendarModal #users_list').html("");
                if(data.users[0] != undefined){
                    name_user = data.users[0].name;
                    id_user = data.users[0].id_user;
                    $('#calendarModal #user').val(name_user);
                    $('#calendarModal #id_user').val(id_user);
                }
            }
        });
    }
});

$('#calendarModal #user').on('input',function (e) {
    var query = $('#calendarModal #user').val();

    $.ajax({
        url: "search/users",
        type: "GET",
        data: {
            'user': query
        },

        success: function (data) {
            $('#calendarModal #users_list').html(data.html);
        }
    });
});

$('#calendarModal #users_list').on('click', function (e) {
    name_user = e.target.firstChild.wholeText;
    id_user = e.target.firstElementChild.innerText;
    $('#calendarModal #users_list').html("");
    $('#calendarModal #user').val(name_user);
    $('#calendarModal #id_user').val(id_user);
});

$('#editModal #users_list').on('click', function (e) {
    name_user = e.target.firstChild.wholeText;
    id_user = e.target.firstElementChild.innerText;
    $('#editModal #users_list').html("");
    $('#editModal #user').val(name_user);
    $('#editModal #id_user').val(id_user);
});

$.ajax({
    type: 'GET',
    url: "calendar",
    success: function (data) {
        for (var i = 0; i < data.length; i++) {
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
            headerToolbar: {
                center: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
            },
            initialView: 'dayGridMonth',
            locale: 'es',
            firstDay: 1,
            height: 820,
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
            selectable: true,
            selectHelper: true,
            select: function (start, end) {
                $('#calendarModal #titleError').hide();
                $('#calendarModal #modalTitle').html('Título del evento');
                $('#calendarModal #title').val('');
                $('#calendarModal #user').val('');
                $('#calendarModal #description').val('');
                $('#calendarModal #start').val(moment(start.startStr).format('YYYY-MM-DDTHH:mm'));
                $('#calendarModal #end').val(moment(start.endStr).format('YYYY-MM-DDTHH:mm'));
                $('#calendarModal').modal();
                $('#calendarModal #saveEvent').off('click');
                $('#calendarModal #saveEvent').on('click',function (event) {
                    var id;
                    var title = $('#calendarModal #title').val();
                    var start = $('#calendarModal #start').val();
                    var end = $('#calendarModal #end').val();
                    var description = $('#calendarModal #description').val();
                    $.ajax({
                        url: "calendar/create",
                        data: 'title=' + title + '&start=' + start + '&end=' + end + '&description=' + description + '&name_user=' + name_user + '&id_user=' + id_user,
                        type: "POST",
                        success: function (id) {
                            console.log("¡Añadido satisfactoriamente!");
                            calendar.addEvent({
                                id: id,
                                title: title,
                                start: start,
                                end: end,
                                description: description,
                                name_user: name_user,
                                id_user: id_user
                            });
                            calendar.unselect();
                            $('#calendarModal #titleError').hide();
                            $('#calendarModal').modal('hide');
                        },
                        error: function (err) {
                            $('#calendarModal #titleError').html(err.responseJSON.errors.title);
                            $('#calendarModal #titleError').show();
                            console.log(err);
                        }
                    });
                });
                $('#calendarModal #closeModal').on('click', function(){
                    $('#calendarModal #users_list').html("");
                });
            },
            eventDrop: function (info) {
                var start = moment(info.event.startStr).format('YYYY-MM-DDTHH:mm');
                var end = moment(info.event.endStr).format('YYYY-MM-DDTHH:mm');
                $.ajax({
                    url: "calendar/update",
                    data: 'title=' + info.event.title + '&start=' + start + '&end=' + end + '&id=' + info.event.id,
                    type: "PUT",
                    success: function (response) {
                        console.log("¡Modificado satisfactoriamente!")
                    }
                });
            },
            eventClick: function (event) {
                $('#editModal').modal();
                $('#editModal #modalTitle').html('Editar evento');
                $("#editModal #deleteEvent").off('click');
                $('#editModal #title').val(event.event.title);
                $('#editModal #start').val(moment(event.event.startStr).format('YYYY-MM-DDTHH:mm'));
                $('#editModal #end').val(moment(event.event.endStr).format('YYYY-MM-DDTHH:mm'));
                $('#editModal #user').val(event.event._def.extendedProps.name_user);
                $('#editModal #description').val(event.event._def.extendedProps.description);
                $('#editModal #saveEvent').off('click');
                $('#editModal #saveEvent').on('click', function() {
                    var title = $('#editModal #title').val();
                    var start = $('#editModal #start').val();
                    var end = $('#editModal #end').val();
                    var name_user = $('#editModal #user').val();
                    var description = $('#editModal #description').val();
                    if(id_user == "")
                        id_user = event.event.extendedProps.id_user;
                    $.ajax({
                        url: 'calendar/edit',
                        type: 'PUT',
                        data:{
                            id: event.event.id,
                            title: title,
                            start: start,
                            end: end,
                            id_user: id_user,
                            name_user: name_user,
                            description: description
                        },
                        success: function(response){
                            console.log("¡Modificado satisfactoriamente!");
                            var eventModify = calendar.getEventById(event.event.id);
                            eventModify.setProp('title', title);
                            eventModify.setStart(start);
                            eventModify.setEnd(end);
                            eventModify.setExtendedProp('id_user', id_user);
                            eventModify.setExtendedProp('name_user',name_user);
                            eventModify.setExtendedProp('description',description);
                        }
                    });
                    
                    $('#editModal').modal('hide');
                });
                $('#editModal #deleteEvent').on('click',function () {
                    $('#deleteModal').modal();
                    $('#deleteModal #confirmDelete').off('click');
                    $('#deleteModal #confirmDelete').on('click',function(){
                        $.ajax({
                            type: "DELETE",
                            url: "calendar/delete",
                            data: "&id=" + event.event.id,
                            success: function (response) {
                                if (parseInt(response) > 0) {
                                    var eventToDelete = calendar.getEventById(event.event.id);
                                    eventToDelete.remove();
                                    console.log("¡Eliminado satisfastoriamente!");
                                }
                            }
                        });
                        $('#deleteModal').modal('hide');
                    });
                    });
                $('#editModal #closeModal').on('click', function(){
                    $('#editModal #users_list').html("");
                });
            }
        });

        calendar.setOption('locale', 'es');
        calendar.render();
    }
});
