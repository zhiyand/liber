@extends('layouts.app')

@section('content')

    @foreach($books as $book)

        <div class="card">
            <img class="card-img-top" src="{{ asset($book->cover) }}" alt="{{ $book->title }}">
            <div class="card-block">
                <h4 class="card-title">{{ $book->title }}</h4>
                <p class="card-text">{{ $book->description }}</p>
                <a href="#" class="btn btn-primary">
                    <span class="fa fa-inbox"></span>
                    Borrow
                </a>
            </div>
        </div>

    @endforeach

@stop
