<div id="navigation">
    <nav class="navbar navbar-full navbar-light bg-faded">
        <div class="container">
            <a class="navbar-brand" href="/">Liber</a>
            <ul class="nav navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="/"><span class="fa fa-home"></span> Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pricing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
            </ul>
            <ul class="nav navbar-nav pull-xs-right">
            @if(auth()->check())
                <li class="nav-item">
                    <a class="nav-link" href="#">Account</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/auth/logout">Logout</a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="/auth/login">Login</a>
                </li>
            @endif
        </div><!-- .container -->
    </nav>
</div><!-- #navigation -->
