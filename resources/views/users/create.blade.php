@extends('layouts.app')

@section('content')

<div class="FormBox">

    <h1 class="FormBox__title">Add a new User</h1>

    @include('partials.error')

    <form method="POST" action="{{ route('users.store') }}">
        {!! csrf_field() !!}

        <div class="form-group">
            <input type="text" name="name" value="{{ old('name') }}"
                class="form-control" placeholder="Name...">
        </div>

        <div class="form-group">
            <input type="email" name="email" value="{{ old('email') }}"
                class="form-control" placeholder="Email...">
        </div>

        <div class="form-group">
            <input type="text" name="birthday" value="{{ old('birthday') }}"
                class="form-control" placeholder="Birthday (YYYY-MM-DD)">
        </div>

        <div class="form-group">
            <input type="password" name="password"
                class="form-control" placeholder="Password...">
        </div>

        <div class="form-group">
            <input type="password" name="password_confirmation"
                class="form-control" placeholder="Confirm password...">
        </div>

        <div class="form-group">
            <select name="role" class="form-control">
                <option value="user">User</option>
                <option value="librarian">Librarian</option>
                <option value="administrator">Administrator</option>
            </select>
        </div>

        <button class="btn btn-default btn-primary pull-xs-right" type="submit">
            <span class="fa fa-plus"></span> Add
        </button>
    </form>
</div>

@stop
