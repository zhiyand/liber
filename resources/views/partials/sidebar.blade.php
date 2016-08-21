@if($me && $me->isAdmin())
    <div class="Widget">
        <a href="{{ route('books.create') }}" class="btn btn-primary">
            <span class="fa fa-plus"></span>
            Add new Book
        </a>
    </div>
@endif

@if($me)
    <div class="List Widget">

        <h3 class="List__title">My Book Loans</h3>

    @if($me->loans->count())
        <ul>
            @foreach($me->loans as $loan)
                <li>
                    <a href="{{ route('loans.show', $loan->id) }}">
                        {{ $loan->book->title }}
                    </a>
                </li>
            @endforeach
        </ul>
    @endif

    </div>

@endif
