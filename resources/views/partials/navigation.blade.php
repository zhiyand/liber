<div id="navigation">
    <nav class="navbar navbar-full navbar-light bg-faded">
        <div class="container">
            <a class="navbar-brand" href="/">Liber</a>
            <ul class="nav navbar-nav">
                <li class="nav-item {{ request()->is('books*') ? 'active' : '' }}">
                    <a class="nav-link" href="/books">
                        <span class="fa fa-bank"></span>
                        Library
                    </a>
                </li>
                @if($me && $me->isAdmin())
                    <li class="nav-item {{ request()->is('users*') ? 'active' : '' }}">
                        <a class="nav-link" href="/users">
                            <span class="fa fa-users"></span>
                            Users
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('reports*') ? 'active' : '' }}">
                        <a class="nav-link" href="/reports/summary">
                            <span class="fa fa-area-chart"></span>
                            Report
                        </a>
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
