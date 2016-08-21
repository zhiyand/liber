@extends('layouts.app')

@section('content')
<div class="row">
<div class="col-md-9">

    <h3>Book Loans</h3>

    @foreach($loans->chunk(4) as $chunk)
        <div class="row">
        @foreach($chunk as $loan)
            <div class="col-md-3">
                <div class="card BookCard">
                    <a href="{{ route('loans.show', $loan->id) }}">
                        <img class="card-img-top" src="{{ asset($loan->book->cover) }}" alt="{{ $loan->book->title }}">
                    </a>
                    <div class="card-block">
                        <h4 class="card-title">
                            {{ $loan->book->title }}
                        </h4>
                        <p class="card-text"><em>{{ $loan->book->author }}</em></p>
                    </div>
                </div><!-- .card -->
            </div><!-- .col -->
        @endforeach
        </div><!-- .row -->
    @endforeach

    @include('partials.pagination', ['items' => $loans])
</div>
<div class="col-md-3">
    @include('partials.sidebar')
</div>
</div><!-- .row -->
@stop
