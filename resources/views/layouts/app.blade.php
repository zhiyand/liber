<!DOCTYPE html>
<html>
    <head>
        <title>Liber</title>
        <link rel="stylesheet" type="text/css" href="/css/app.css">
        <script src="/js/bundle.js"></script>
        @yield('header')
    </head>
    <body>
        @include('partials.navigation')

        <div id="page">
            <div class="container">
                @yield('content')
            </div>
        </div>

        @include('partials.footer')

        @yield('footer')
    </body>
</html>
