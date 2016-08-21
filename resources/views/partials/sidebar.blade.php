@if(auth()->user()->isAdmin())
    <a href="{{ route('books.create') }}" class="btn btn-primary">
        <span class="fa fa-plus"></span>
        Add new Book
    </a>
@endif
