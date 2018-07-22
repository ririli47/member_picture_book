@extends('layouts.app')

@section('content')
<link href="{{ asset('css/top.css') }}" rel="stylesheet">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="text-center">
                <img src="{{ $member->getProfile()->getAvatarUrl() }}" class="rounded round-icon-home" alt="icon"><br>
                {{$name}}
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
       <p>
        {{$profile->profile}}
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

    <div class="row justify-content-center">
        <a href="/member/interest/{{$member_id}}">
            <img src="/img/interest.png" class="rounded round-icon" alt="icon">
            </br>
            <div class="text-center">
                <p>きになる！</p>
            </div>
        </a>
    </div>

    <section>
        <h3>タグ付け</h3>

        <form method="post" action="{{ route('tag/add') }}">
            {{ csrf_field() }}
            <input type="text" name="tag_name">
            <input type="hidden" name="user_id" value="{{$member_id}}">
            <input type="submit" value="add">
        </form>

        <ul>
        @forelse ($member->getUserTags() as $userTag)
            <li>
                @php($tag = $userTag->getTag())
                tag.id: {{ $tag->getId() }} / {{ $tag->getName() }}
                <form style="display: inline-block" method="post" action="{{ route('tag/remove') }}">
                    {{ csrf_field() }}
                    <input name="_method" type="hidden" value="DELETE">
                    <input type="hidden" name="user_tag_id" value="{{ $userTag->getId() }}">
                    <input type="submit" value="x">
                </form>
            </li>
        @empty
            <p>no tags.</p>
        @endforelse
        </ul>

    </section>
</div>
@endsection
