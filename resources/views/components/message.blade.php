@if (Session::has('success'))
<div class="w-25 ms-3">
    <div class="alert alert-success">
        {{ Session::get('success') }}
    </div>
</div>
@endif

@if ($errors->any())
<div class="w-25 ms-3">
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif