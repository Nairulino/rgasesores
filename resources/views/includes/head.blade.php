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
</head>