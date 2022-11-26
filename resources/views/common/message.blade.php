@if($errors->any())
    <div class="alert alert-danger mb-5" role="alert">
        @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </div>
@endif

@if(Session::has('message'))
    <div class="alert alert-success mb-5" role="alert">
        {{ session('message') }}
    </div>
@endif
