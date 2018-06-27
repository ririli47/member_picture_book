@extends('layouts.app')

@section('content')
<link href="{{ asset('css/top.css') }}" rel="stylesheet">

<div class="container">
    <form action="/home/edit" method="POST">
        {{csrf_field()}}
            <input type="hidden" name="user_id" id="user_id" value={{$user_id}}>
            <div class="form-group">
                <label for="name">user name</label>
                <input type="text" name="name" class="form-control" id="name" value={{$name}}>
            </div>
            <div class="form-group">
                <label for="profile">profile</label>
                <input type="text" name="profile" class="form-control" id="profile" value="{{$profile}}">
            </div>
        <button type="submit" class="btn btn-primary mb-2">Profile Save</button>
    </form>
</div>
@endsection
