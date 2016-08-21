@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-sm-9">
            @include('partials.error')
            @include('partials.message')

            <h1>{{ $book->title }}</h1>

            <p><small>Author: {{ $book->author }}</small></p>

            <p>
                <img src="{{ asset($book->cover) }}" class="pull-xs-left" style="margin: 0 1rem 1rem 0;">
                {{ $book->description }}

                <p>
                @if($loan->closed)
                    <span class="tag tag-danger">Returned</span>
                @else
                    <span class="tag tag-success">Active</span>
                @endif
                </p>

                <ul style="list-style-position:inside">
                    <li>Loaned to: {{ $loan->user->name }}</li>
                    <li>Borrowed at: <code>{{ $loan->created_at }}</code></li>
                    <li>Expiry: <code>{{ $loan->expiry }}</code></li>

                    @if($loan->expired)
                        <li>Fine: {{ $loan->fine }}</li>
                    @endif

                    @if($loan->closed)
                        <li>Returned at: <code>{{ $loan->returned_at }}</code></li>
                    @endif
                </ul>
            </p>

            @if($loan->status == 'active')
            <form style="display:inline"
                  method="POST"
                  action="{{ route('loans.destroy', $loan->id) }}">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="book_id" value="{{ $book->id }}">
                <button type="submit" class="btn btn-sm btn-secondary">
                    <span class="fa fa-reply-all"></span>
                    Return Book
                </button>
            </form>
            @endif

        </div>
    </div>

@stop
