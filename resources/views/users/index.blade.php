@extends('layouts.app')

@section('content')

<h2>
    User Management

    <a href="{{ route('users.create') }}" class="btn btn-sm btn-secondary pull-xs-right">
        <span class="fa fa-plus"></span>
        Add a User
    </a>
</h2>

@include('partials.error')
@include('partials.message')

<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Age</th>
            <th>Role</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email}}</td>
            <td>{{ $user->age }}</td>
            <td>{{ $user->role }}</td>
            <td>
                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-secondary">
                    <span class="fa fa-pencil"></span>
                    Edit
                </a>
                <form method="POST"
                      style="display:inline;"
                      action="{{ route('users.destroy', $user->id) }}">
                      {{ csrf_field() }}
                      <input type="hidden" name="_method" value="DELETE">

                      <button id="delete-user-{{ $user->id }}" class="btn btn-danger btn-sm" type="submit">
                          <span class="fa fa-trash"></span>
                          Delete
                      </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@include('partials.pagination', ['items' => $users])

@stop

