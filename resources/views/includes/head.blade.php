<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Nairulino">
    <link rel="icon" type="image/gif" sizes="16x16" href="img/Logo8x6mm.gif">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- jQuery -->
    <script src="{{ URL::asset('js/jquery-3.5.1.min.js') }}"></script>
    <!-- Moments JS -->
    <script src="{{ URL::asset('js/moment-with-locales.min.js') }}"></script>
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="{{ URL::asset('bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Menu CSS -->
    <link rel="stylesheet" href="{{ URL::asset('../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css') }}">
    <!-- animation CSS -->
    <link rel="stylesheet" href="{{ URL::asset('css/animate.css') }}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">
    <!-- color CSS -->
    <link rel="stylesheet" href="{{ URL::asset('css/colors/default.css') }}">
    <!-- Fullcalendar CSS -->
    <link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var SITEURL = "{{ url('/') }}";
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var events = [];
            var id_user = "";
            var name_user = "";
            $('#user').on('keyup',function() {
                    var query = $('#user').val(); 

                    $.ajax({                  
                        url:"{{ route('users.search') }}",          
                        type:"GET",              
                        data:{'user':query},
                       
                        success:function (data) {
                            $('#user_list').html(data.html);
                        }
                    });
                });

                $(document).on('click', 'li', function(){
                    name_user = this.innerText;
                    $('#user').val(name_user);
                    id_user =  this.firstElementChild.innerText;
                    $('#user_list').html("");
                });

            $.ajax({
                type: 'GET',
                url: "{{ route('calendar') }}",
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
                        initialView: 'dayGridMonth',
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
                            $('#modalTitle').html('Título del evento');
                            $('#calendarModal #title').val('');
                            $('#calendarModal #user').val('');
                            $('#calendarModal #description').val('');
                            $('#calendarModal #start').val(moment(start.startStr).format('YYYY-MM-DDTHH:mm'));
                            $('#calendarModal #end').val(moment(start.endStr).format('YYYY-MM-DDTHH:mm'));
                            $('#calendarModal').modal();
                            $("#saveEvent").unbind('click');
                            $("#saveEvent").click(function (event) {
                                var id;
                                var title = $('#calendarModal #title').val();
                                var start = $('#calendarModal #start').val();
                                var end = $('#calendarModal #end').val();
                                var description = $('#calendarModal #description').val();
                                // var id_user = 
                                $.ajax({
                                    url: "{{ route('calendar.create') }}",
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
                        },
                        eventDrop: function (info) {
                            var start = moment(info.event.startStr).format('YYYY-MM-DDTHH:mm');
                            var end = moment(info.event.endStr).format('YYYY-MM-DDTHH:mm');
                            $.ajax({
                                url: "{{route('calendar.update')}}",
                                data: 'title=' + info.event.title + '&start=' + start + '&end=' + end + '&id=' + info.event.id,
                                type: "POST",
                                success: function (response) {
                                    console.log("¡Modificado satisfactoriamente!")
                                }
                            });
                        },
                        eventClick: function (event) {
                            $('#deleteModal').modal();
                            $("#confirmDelete").unbind('click');
                            $('#confirmDelete').click(function () {
                                $.ajax({
                                    type: "POST",
                                    url: "{{ route('calendar.delete') }}",
                                    data: "&id=" + event.event.id,
                                    success: function (response) {
                                        if (parseInt(response) >
                                            0) {
                                            var eventToDelete =
                                                calendar
                                                .getEventById(event
                                                    .event.id);
                                            eventToDelete.remove();
                                            console.log("¡Eliminado satisfastoriamente!");
                                        }
                                    }
                                });
                                $('#deleteModal').modal('hide');
                            });
                        }
                    });

                    calendar.setOption('locale', 'es');
                    calendar.render();
                }
            });


        });

        function displayMessage(message) {
            $(".response").html(message);
            setInterval(function () {
                $(".success").fadeOut();
            }, 1000);
        }

    </script>

</head>