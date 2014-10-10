<!-- Success notifications -->
@if(Session::has('success'))
    <div class="alert alert-success" role="alert">
        {{ Session::get('success') }}
    </div>
<!-- Error notifications -->
@elseif(Session::has('error'))
    <div class="alert alert-warning" role="alert">
        {{ Session::get('error') }}
    </div>
@endif
