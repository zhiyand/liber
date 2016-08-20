@extends('layouts.app')

@section('content')

<div class="FormBox">

    <h1 class="FormBox__title">Add a new Book</h1>

    @include('partials.error')

    <form method="POST" action="{{ route('books.store') }}" enctype="multipart/form-data">
        {!! csrf_field() !!}

        <div class="form-group">
            <input type="text" name="title" value="{{ old('title') }}"
                class="form-control" placeholder="Title...">
        </div>

        <div class="form-group">
            <input type="text" name="author" value="{{ old('author') }}"
                class="form-control" placeholder="Author...">
        </div>

        <div class="form-group">
            <input type="text" name="isbn" value="{{ old('isbn') }}"
                class="form-control" placeholder="ISBN...">
        </div>

        <div class="form-group">
            <input type="number" name="quantity" value="{{ old('quantity') }}"
                class="form-control" placeholder="Quantity">
        </div>

        <div class="form-group">
            <input type="text" name="shelf" value="{{ old('shelf') }}"
                class="form-control" placeholder="Shelf Location...">
        </div>

        <div class="form-group">
            <textarea class="form-control" name="description" cols="30" rows="6" placeholder="Description...">{{ old('description') }}</textarea>
        </div>
        <div class="form-group">
            <input type="file" class="form-control" name="cover">
        </div>

        <button class="btn btn-default btn-primary pull-xs-right" type="submit">
            <span class="fa fa-plus"></span> Add
        </button>
    </form>
</div>

@stop
