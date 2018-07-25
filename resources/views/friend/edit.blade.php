@extends('layouts.app')

@section('content')
<link href="{{ asset('css/top.css') }}" rel="stylesheet">

<div class="container">
    <form action="/friend/delete" method="POST">
        {{csrf_field()}}
        <input type="hidden" name="user_id" id="user_id" value={{$user_id}}>
        <div class="form-group">
            <label for="name">Delete Your Friends!</label>
            <select name="friend_id">
            @foreach ($friends as $friend)
                <option value={{$friend->id}}>{{$friend->name}}</option>
            @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary mb-2">Delete friend</button>
    </form>

    <form action="/friend/add" method="POST">
        {{csrf_field()}}
        <input type="hidden" name="user_id" id="user_id" value={{$user_id}}>
        <div class="form-group">
            <label for="name">Make Your Friends!</label>
            <select name="friend_id">
            @foreach ($members as $member)
                @if ($member->id != $user_id)
                    <option value={{$member->id}}>{{$member->name}}</option>
                @endif
            @endforeach
            </select>
        </div>
        @if($message != null)
            <p>{{$message}}</p>
        @endif
        <button type="submit" class="btn btn-primary mb-2">Make Friend</button>
    </form>
</div>
@endsection
