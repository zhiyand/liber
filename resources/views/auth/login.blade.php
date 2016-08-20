@extends("layouts.app")

@section('content')

<div class="FormBox">

    <h1 class="FormBox__title">Liber &raquo; Login</h1>

    <form method="POST" action="/auth/login">
        {!! csrf_field() !!}


        <div class="form-group">
            <input type="email" name="email" value="{{ old('email') }}"
                class="form-control" placeholder="Email">
        </div>

        <div class="form-group">
            <input type="password" name="password"
                class="form-control" placeholder="Password">
        </div>

        <div class="checkbox">
            <label>
                <input type="checkbox" name="remember"> Remember Me
            </label>
        </div>

        <div>
            <button type="submit" class="btn btn-default btn-primary pull-xs-right">Login</button>
        </div>
    </form>

</div>

@stop
