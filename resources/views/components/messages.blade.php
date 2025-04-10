@if(Session::has('mensaje'))
<div class="border p-3 w-full rounded-lg border-red-500" role="alert">
    {{ Session::get('mensaje') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if ($errors->any())
<div class="border p-1 text-center mb-2  rounded-lg border-red-500" role="alert">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@session('success')
<div class="alert p-3 mb-2 alert-success text-dark alert-dismissible fade show" role="alert">
    <ul>
        <li> {{ $value }}</li>
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endsession
