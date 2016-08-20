@if(session('flash_message'))

    <div class="alert alert-info">
        <p style="margin:0">
            {{ session('flash_message') }}
        </p>
    </div>

@endif
