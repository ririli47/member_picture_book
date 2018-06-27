@extends('layouts.app')

@section('content')
<link href="{{ asset('css/top.css') }}" rel="stylesheet">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="text-center">
                <img src="/img/usapi1.png" class="rounded round-icon-home" alt="icon"><br>
                {{$name}}
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
       <p>
        {{$profile}}
        </p>
    </div>

    <div class="text-center">
        仲良い人リスト
        <div class="row justify-content-center">
        @if (count($friends) == 0)
            <p>No Friends...</p>
        @else
            @foreach ($friends as $friend)
                <div class="col-md-4">
                    <p>{{$friend->name}}</p>
                </div>
            @endforeach
        @endif
        </div>
    </div>
</div>
@endsection
