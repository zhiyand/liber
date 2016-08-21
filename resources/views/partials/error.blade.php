@if($errors->any())

    <div class="alert alert-danger">
        @if($errors->count() > 1)
        <ul style="margin:0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        @else
            {{ $errors->first() }}
        @endif
    </div>

@endif
