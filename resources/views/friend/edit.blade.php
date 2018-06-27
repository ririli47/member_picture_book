@extends('layouts.app')

@section('content')
<link href="{{ asset('css/top.css') }}" rel="stylesheet">

<div class="container">
    <form action="/friend/edit" method="POST">
        {{csrf_field()}}
            <input type="hidden" name="user_id" id="user_id" value={{$user_id}}>
            <div class="form-group">
                <label for="name">user name</label>
                <select name="friend_id">
                @foreach ($members as $member)
                <option value={{$member->id}}>{{$member->name}}</option>
                @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary mb-2">Profile Save</button>
    </form>
</div>
@endsection
