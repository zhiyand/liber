@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-sm-8">
            @include('partials.error')
            @include('partials.message')

            <h1>{{ $book->title }}</h1>

            <p><small>Author: {{ $book->author }}</small></p>

            <p>{{ $book->description }}</p>

            <form style="display:inline"
                  method="POST"
                  action="{{ route('loans.store') }}">
                {{ csrf_field() }}
                <input type="hidden" name="book_id" value="{{ $book->id }}">
                <button type="submit" class="btn btn-sm btn-secondary">
                    <span class="fa fa-inbox"></span>
                    Borrow
                </button>
            </form>

            @can('destroy', $book)
            <a href="{{ route('books.edit', $book->id) }}" class="btn btn-sm btn-secondary">
                <span class="fa fa-pencil"></span>
                Edit
            </a>
            <form style="display:inline;" action="{{ route('books.destroy', $book->id) }}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="DELETE">
                <button class="btn btn-sm btn-danger" type="submit">
                    <span class="fa fa-ban"></span>
                    Delete
                </button>
            </form>
            @endcan
        </div>
        <div class="col-sm-4">
            <img src="{{ asset($book->cover) }}">

            <ul>
                <li>ISBN: {{ $book->isbn }}</li>
                <li>Quantity: {{ $book->quantity }}</li>
                <li>In Circulation: {{ $book->loaned }}</li>
                <li>On Shelf: {{ $book->shelf }}</li>
            </ul>
        </div>
    </div>

@stop
