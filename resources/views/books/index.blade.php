@extends('layouts.app')

@section('content')

    @foreach($books->chunk(4) as $chunk)
        @foreach($chunk as $book)
        <div class="card">
            <img class="card-img-top" src="{{ asset($book->cover) }}" alt="{{ $book->title }}">
            <div class="card-block">
                <h4 class="card-title">
                    <a href="{{ route('books.show', $book->id) }}">{{ $book->title }}</a>
                </h4>
                <p class="card-text">{{ $book->description }}</p>
                <a href="#" class="btn btn-primary">
                    <span class="fa fa-inbox"></span>
                    Borrow
                </a>
            </div>
        </div>
        @endforeach
    @endforeach

@stop
