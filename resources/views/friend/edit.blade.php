@extends('layouts.app')

@section('content')
<link href="{{ asset('css/top.css') }}" rel="stylesheet">

<div class="container">
    <form action="/friend/edit" method="POST">
        {{csrf_field()}}
            <input type="hidden" name="user_id" id="user_id" value={{$user_id}}>
            <div class="form-group">
                <label for="name">Your Friends!</label>
                <select name="friend_id">
                @foreach ($members as $member)
                    @if ($member->id != $user_id)
                        <option value={{$member->id}}>{{$member->name}}</option>
                    @endif
                @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary mb-2">Profile Save</button>
    </form>
</div>
@endsection
