@php($message = session()->get('message_success'))
@if ($message)
<div class="container">
    <div class="row justify-content-center alert alert-success">
        {{ $message }}
    </div>
</div>
@endif
@php($errors = session()->get('errors'))
@if ($errors)
<div class="container">
    <div class="row justify-content-center alert alert-danger">
        <ul class="list-group">
    @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
    @endforeach
        </ul>
    </div>
</div>
@endif
