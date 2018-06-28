@extends('layouts.app')

@section('content')
<link href="{{ asset('css/top.css') }}" rel="stylesheet">

<div class="container">
    <div class="row justify-content-center">
        <h3>{{$member->name}}さんに「気になる」を送ろうとしています！</h3></br>
    </div>
    <div class="row justify-content-center">
        <p>※相手に通知が行きます。</p>
    </div>

    <div class="row justify-content-center">
        <form action="/member/interest/" method="POST">
            {{csrf_field()}}
            <input type="hidden" name="user_id" id="user_id" value={{$user->id}}>
            <input type="hidden" name="interest_user_id" id="interest_user_id" value={{$member->id}}>
            <input type="hidden" name="read" id="read" value="0">
            <button type="submit" class="btn btn-primary">気になるを送る</input>
        </form>
    </div>
</div>

@endsection
