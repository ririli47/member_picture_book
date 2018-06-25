@extends('layouts.app')

@section('content')
<link href="{{ asset('css/top.css') }}" rel="stylesheet">
<div class="container">
    <div class="row justify-csontent-center">
        <div class="col-md-12">
            <h1 class="text-center">isao図鑑</h1>
        </div>
    </div>
    <div class="row justify-csontent-center">
        <div class="col-md-12">
            <div class="search_form">
                <form class="form" action="" method="POST">
                    {{csrf_field()}}
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="#白米 検索">
                    </div>
                    <button  type="submit" class="btn btn-default" >Send</button>
                </form>
            </div>
        </div>
    </div>


    <div class="row justify-content-center">
        @foreach ($members as $member)
            <div class="col-md-4">
                <div class="text-center">
                    <img src="/img/usapi1.png" class="rounded round-icon" alt="icon"><br>
                    {{$member->name}}
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
