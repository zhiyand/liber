@if($me && $me->isAdmin())
    <div class="Widget">
        <a href="{{ route('books.create') }}" class="btn btn-primary">
            <span class="fa fa-plus"></span>
            Add new Book
        </a>
    </div>
@endif

@if($me)
    <div class="Widget">
        <form action="/books/search">
            <div class="input-group">
                <input type="text" name="q" placeholder="Search for..." class="form-control">
                <span class="input-group-btn">
                    <button class="btn btn-secondary" type="submit" id="btn-search">
                        <span class="fa fa-search"></span>
                    </button>
                </span>
            </div>
        </form>

    </div>
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
