<div class="card BookCard">
    <a href="{{ route('books.show', $book->id) }}">
        <img class="card-img-top" src="{{ asset($book->cover) }}" alt="{{ $book->title }}">
    </a>
    <div class="card-block">
        <h4 class="card-title">
            {{ $book->title }}
        </h4>
        <p class="card-text"><em>{{ $book->author }}</em></p>
    </div>
</div><!-- .card -->
