<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('includes.head')

<body id="body"  class="fix-header">
    <div id="wrapper">
        <header>

            @include('includes.header')

        </header>

        @include('includes.sidebar')
        
        <main id="page-wrapper">
            
            @yield('content')
            
        </main>

        @include('includes.footer')

    </div>
</body>

</html>
