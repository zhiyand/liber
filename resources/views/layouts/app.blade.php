<!DOCTYPE html>
<html>
    <head>
        <title>Liber</title>
        <link rel="stylesheet" type="text/css" href="/css/app.css">
    </head>
    <body>
        @include('partials.navigation')

        <div id="page">
            <div class="container">
                @yield('content')
            </div>
        </div>
    </body>
</html>
