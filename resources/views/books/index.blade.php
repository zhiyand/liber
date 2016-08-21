@extends('layouts.app')

@section('content')
<div class="row">
<div class="col-md-9">
    @foreach($books->chunk(4) as $chunk)
        <div class="row">
        @foreach($chunk as $book)
            <div class="col-md-3">
                <div class="card BookCard">
                    <a href="{{ route('books.show', $book->id) }}">
                        <img class="card-img-top" src="{{ asset($book->cover) }}" alt="{{ $book->title }}">
                    </a>
                    <div class="card-block">
                        <h4 class="card-title">
                            <a href="{{ route('books.show', $book->id) }}">{{ $book->title }}</a>
                        </h4>
                        <a href="#" class="btn btn-secondary btn-sm">
                            <span class="fa fa-inbox"></span>
                            Borrow
                        </a>
                    </div>
                </div><!-- .card -->
            </div><!-- .col -->
        @endforeach
        </div><!-- .row -->
    @endforeach

    @include('partials.pagination', ['items' => $books])
</div>
<div class="col-md-3">
    @include('partials.sidebar')
</div>
</div><!-- .row -->
@stop
