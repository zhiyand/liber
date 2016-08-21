@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-sm-8">
            @include('partials.error')
            @include('partials.message')

            <h1>{{ $book->title }}</h1>

            <p><small>Author: {{ $book->author }}</small></p>

            <p>{{ $book->description }}</p>

            <p>
            @if($me)
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
            @endif

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
            </p>

            @if($me && $me->isAdmin())
                @if($book->loans->count() > 0)
                    <h2>Loan History</h2>
                    <ul class="list-group">
                        @foreach($book->loans as $loan)
                            <li class="list-group-item {{ $loan->closed ? 'disabled' : '' }}">
                                {{ $loan->user->name }}
                                borrowed at <code>{{ $loan->created_at }}</code>
                                @if($loan->closed)
                                    returned at <code>{{ $loan->returned_at }}</code>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @endif
            @endif

        </div>
        <div class="col-sm-4">

            <div class="card BookCard" style="max-width:300px;">
                <a href="{{ route('books.show', $book->id) }}">
                    <img class="card-img-top" src="{{ asset($book->cover) }}" alt="{{ $book->title }}">
                </a>
                <div class="card-block">
                    <h4 class="card-title">
                        {{ $book->title }}
                    </h4>
                    <p class="card-text">
                        <em>{{ $book->author }}</em>
                        <ul>
                            <li>ISBN: {{ $book->isbn }}</li>
                            <li>Quantity: {{ $book->quantity }}</li>
                            <li>In Circulation: {{ $book->loaned }}</li>
                            <li>On Shelf: {{ $book->shelf }}</li>
                        </ul>
                    </p>
                </div>
            </div><!-- .card -->

        </div><!-- .col -->
    </div><!-- .row -->

@stop
