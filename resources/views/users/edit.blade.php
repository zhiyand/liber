@extends('layouts.app')

@section('content')

<div class="FormBox">

    <h1 class="FormBox__title">Edit: {{ $user->name }}</h1>

    @include('partials.error')

    <form method="POST" action="{{ route('users.update', $user->id) }}">
        {!! csrf_field() !!}
        <input type="hidden" name="_method" value="PUT">

        <div class="form-group">
            <input type="text" name="name" value="{{ $user->name }}"
                class="form-control" placeholder="Name...">
        </div>

        <div class="form-group">
            <input type="email" name="email" value="{{ $user->email }}"
                class="form-control" placeholder="Email...">
        </div>

        <div class="form-group">
            <input type="text" name="birthday" value="{{ $user->birthday }}"
                class="form-control" placeholder="Birthday (DD/MM/YYYY)">
        </div>

        <div class="form-group">
            <input type="password" name="password"
                class="form-control" placeholder="Password...">
            <small class="form-text text-muted">(Optional) Leave empty will keep password unchanged</small>
        </div>

        <div class="form-group">
            <input type="password" name="password_confirmation"
                class="form-control" placeholder="Confirm password...">
        </div>

        <div class="form-group">
            <select name="role" class="form-control">
                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                <option value="librarian" {{ $user->role == 'librarian' ? 'selected' : '' }}>Librarian</option>
                <option value="administrator" {{ $user->role == 'administrator' ? 'selected' : '' }}>Administrator</option>
            </select>
        </div>

        <button class="btn btn-default btn-primary pull-xs-right" type="submit">
            <span class="fa fa-pencil"></span> Update
        </button>
    </form>
</div>

@stop
