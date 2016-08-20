<!DOCTYPE html>
<html>
    <head>
        <title>Liber</title>
        <link rel="stylesheet" type="text/css" href="/css/app.css">
        <script src="/js/bundle.js"></script>
        @yield('header')
    </head>
    <body>

        <div id="page">
            <div class="container">
                @yield('content')
            </div>
        </div>

        @yield('footer')
    </body>
</html>
