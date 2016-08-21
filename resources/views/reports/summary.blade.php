@extends('layouts.app')

@section('content')

<table class="table">
    <thead>
        <tr>
            <th>Title</th>
            <th>Author</th>
            <th>Quantity</th>
            <th>Loaned</th>
            <th>Remaining</th>
        </tr>
    </thead>
    <tbody>
        @foreach($books as $book)
        <tr>
            <td><a href="{{ route('books.show', $book->id) }}">{{ $book->title }}</a></td>
            <td>{{ $book->author }}</td>
            <td>{{ $book->quantity }}</td>
            <td>{{ $book->loaned }}</td>
            <td>{{ $book->stock }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@include('partials.pagination', ['items' => $books])

@stop
