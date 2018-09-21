@extends('layouts.app')

@section('content')
<link href="{{ asset('css/top.css') }}" rel="stylesheet">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="text-center">
                <img src="{{ $profile->getAvatarUrl() }}" class="rounded round-icon-home" alt="icon"><br>
                <div class="user-name">
                    {{$name}}
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <p class="user-profile">
            @if ($profile->profile != null)
                {{$profile->profile}}
            @else
                No profile...
            @endif
        </p>
    </div>

    <div class="text-center">
        <h4>
            仲良い人リスト
        </h4>
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

    <div class="text-center">
        <h4>気になってくれている人リスト</h4>
        <div class="row justify-content-center">
            @if($interesteds != null)
                @foreach ($interesteds as $interested)
                    <p>{{$interested->name}}さんがあなたのことを気になっています！</p><br>
                @endforeach
            @else
                <p>気になってくれている人がいません。</p>
            @endif
        </div>
    </div>

    <section class="text-center tags">
    <h4>タグ付け</h4>

    <form method="post" action="{{ route('home/addTag') }}">
        {{ csrf_field() }}
        <input type="text" name="tag_name">
        <input type="submit" value="add">
    </form>

    <ul>
    @forelse ($user->getUserTags() as $userTag)
        <li>
            @php($tag = $userTag->getTag())
            tag.id: {{ $tag->getId() }} / {{ $tag->getName() }}
            <form style="display: inline-block" method="post" action="{{ route('home/removeTag') }}">
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
