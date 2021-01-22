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
            $.ajax({
                type: 'GET',
                url: "{{ route('calendar') }}",
                success: function (data) {
                    for (var i = 0; i < data.length; i++) {
                        events.push({
                            id: data[i].id,
                            title: data[i].title,
                            start: data[i].start,
                            end: data[i].end
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
                            $('#modalTitle').html('Título del evento');
                            $('#calendarModal #title').val('');
                            $('#calendarModal #descripcion').val('');
                            $('#calendarModal #start').val(moment(start.startStr).format('YYYY-MM-DDTHH:mm'));
                            $('#calendarModal #end').val(moment(start.endStr).format('YYYY-MM-DDTHH:mm'));
                            $('#calendarModal').modal();
                            $("#saveEvent").unbind('click');
                            $("#saveEvent").click(function (event) {
                                var id;
                                var title = $('#calendarModal #title').val();
                                var start = $('#calendarModal #start').val();
                                var end = $('#calendarModal #end').val();
                                $.ajax({
                                    url: "{{ route('calendar.create') }}",
                                    data: 'title=' + title + '&start=' + start + '&end=' + end,
                                    type: "POST",
                                    success: function (data) {
                                        console.log("¡Añadido satisfactoriamente!");
                                    },
                                    error: function (err) {
                                        console.log(err);
                                    }
                                });
                                $.ajax({
                                    type: 'GET',
                                    url: "{{ route('calendar.getLastId') }}",
                                    success: function (data) {
                                        calendar.addEvent({
                                            id: data.id,
                                            title: title,
                                            start: start,
                                            end: end
                                        });
                                    }
                                });
                                calendar.unselect();
                                $('#calendarModal').modal('hide');
                            });
                        },

                        // ESTA POR IMPLEMENTAR

                        // eventDrop: function (event, delta) {
                        //     var start = calendar.formatDate(event.start,"Y-MM-DD HH:mm:ss");
                        //     var end = calendar.formatDate(event.end,"Y-MM-DD HH:mm:ss");
                        //     $.ajax({
                        //         url: SITEURL + '/calendar/update',
                        //         data: 'title=' + event.title + '&start=' +
                        //             start + '&end=' + end +
                        //             '&id=' + event.id,
                        //         type: "POST",
                        //         success: function (response) {
                        //             displayMessage("Updated Successfully");
                        //         }
                        //     });
                        // },


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