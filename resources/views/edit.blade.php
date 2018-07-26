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
                <input type="text" name="profile" class="form-control" id="profile" value="{{$profile->profile}}">
            </div>
        <button type="submit" class="btn btn-primary mb-2">Profile Save</button>
    </form>

    <h2>user image</h2>
    <p>
        <img src="{{ $profile->getAvatarUrl() }}">
    </p>
    <form action="{{ route('home/edit/profile_image') }}" method="POST" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
            <label for="profile">profile image</label>
            <input type="file" name="image" class="form-control" accept="image/*">
        </div>
        <button type="submit" class="btn btn-primary mb-2">Change profile image</button>
    </form>
</div>
@endsection
