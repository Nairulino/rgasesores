<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('includes.head')

<body id="body">
    <div id="app">
        <header>

            @include('includes.header')

        </header>

        <main class="py-2">
            
            @yield('content')
            
        </main>

        @include('includes.footer')

    </div>
</body>

</html>
