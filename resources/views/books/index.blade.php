@extends('layouts.app')

@section('content')
<div class="row">
<div class="col-md-9">

    @if(isset($term))
        <h3>Search results for <em>{{ $term }}</em></h3>
    @endif

    @foreach($books->chunk(4) as $chunk)
        <div class="row">
        @foreach($chunk as $book)
            <div class="col-md-3">
                @include('books._book')
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
