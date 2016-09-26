@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-4" style="padding-bottom: 30px">
            <img src="{{ asset('storage/'.$user->avatar)}}" style="width: 150px;display: block;margin: 0 auto">
            <h3>{{$user->name}}</h3>
            {{--@if(Auth::user())--}}
                {{--<a>Edit profile</a>--}}
            {{--@endif--}}
            <hr>
            <p><a href="mailto:{{$user->email}}">{{$user->email}}</a></p>
            <p>Joined on {{$user->created_at}}</p>
        </div>
        <div class="col-xs-12 col-md-8">
            <ul class="nav nav-tabs">
                <li role="presentation" class="active"><a href="#">Articles</a></li>
                <li role="presentation"><a href="#">Messages</a></li>
                <li role="presentation"><a href="#">Settings</a></li>
            </ul>

                @foreach ($user->articles as $article)
                    <div class="media">
                        <a href="{{ url('article/'.$article->id) }}">{{$article->title}}</a>
                    </div>
                @endforeach

        </div>
    </div>
</div>
@endsection
