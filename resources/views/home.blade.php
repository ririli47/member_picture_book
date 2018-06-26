@extends('layouts.app')

@section('content')
<link href="{{ asset('css/top.css') }}" rel="stylesheet">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="text-center">
                <img src="/img/usapi1.png" class="rounded round-icon" alt="icon"><br>
                {{$name}}
            </div>
        </div>
    </div>
    
    <div class="row justify-content-center">
       <p>
        Profile text area
        </p>
    </div>

    <div class="text-center">
        仲良い人リスト
        <div class="row justify-content-center">
            <div class="col-md-4">
                <p>human1</p>
            </div>
            <div class="col-md-4">
                <p>human2</p>
            </div>
            <div class="col-md-4">
                <p>human3</p>
            </div>
        </div>
    </div>
</div>
@endsection
