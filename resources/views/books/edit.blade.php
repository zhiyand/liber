@extends('layouts.app')

@section('content')

<div class="FormBox">

    <h1 class="FormBox__title">Edit: {{ $book->title }}</h1>

    @include('partials.error')

    <form method="POST" action="{{ route('books.update', $book->id) }}" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="PUT">
        {!! csrf_field() !!}

        <div class="form-group">
            <input type="text" name="title" value="{{ $book->title }}"
                class="form-control" placeholder="Title...">
        </div>

        <div class="form-group">
            <input type="text" name="author" value="{{ $book->author }}"
                class="form-control" placeholder="Author...">
        </div>

        <div class="form-group">
            <input type="text" name="isbn" value="{{ $book->isbn }}"
                class="form-control" placeholder="ISBN...">
        </div>

        <div class="form-group">
            <input type="number" name="quantity" value="{{ $book->quantity }}"
                class="form-control" placeholder="Quantity">
        </div>

        <div class="form-group">
            <input type="text" name="shelf" value="{{ $book->shelf }}"
                class="form-control" placeholder="Shelf Location...">
        </div>

        <div class="form-group">
            <textarea class="form-control" name="description" cols="30" rows="6" placeholder="Description...">{{ $book->description }}</textarea>
        </div>
        <div class="form-group">
            <img src="{{ asset($book->cover) }}">
            <input type="file" class="form-control" name="cover">
        </div>

        <button class="btn btn-default btn-primary pull-xs-right" type="submit">
            Update
        </button>
    </form>
</div>

@stop

