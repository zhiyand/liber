<div id="navigation">
    <nav class="navbar navbar-full navbar-light bg-faded">
        <div class="container">
            <a class="navbar-brand" href="/">Liber</a>
            <ul class="nav navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="/"><span class="fa fa-home"></span> Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/books">Library</a>
                </li>
                @if($me && $me->isAdmin())
                    <li class="nav-item">
                        <a class="nav-link" href="/users">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/reports/summary">Report</a>
                    </li>
                @endif
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
