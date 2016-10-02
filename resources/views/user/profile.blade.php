@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-4" style="padding-bottom: 30px">
            <img src="{{ asset('storage/'.$user->avatar)}}" style="width: 150px;height: 150px; display: block;margin: 0 auto">
            <h3>{{$user->name}}</h3>
            @if(!is_null($user->bio))
                <p>{{ $user->bio }}</p>
            @endif
            @if(Auth::check()&&Auth::id()==$user->id)
                <a href="{{ url('/settings') }}">Edit profile</a>
            @endif
            <hr>
            <p><span class="glyphicon glyphicon-envelope" style="color: #888"></span> <a href="mailto:{{$user->email}}"> {{$user->email}}</a></p>

            @if(!is_null($user->site))
                <p><span class="glyphicon glyphicon-link" style="color: #888"></span> <a href="{{ $user->site }}" target="_blank"> {{ $user->site }}</a></p>
            @endif
            <p> <span class="glyphicon glyphicon-time" style="color: #888"></span>  Joined on {{$user->created_at}}</p>
        </div>
        <div class="col-xs-12 col-md-8">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#">Articles</a></li>
                @if(Auth::check()&&Auth::id()==$user->id)
                    <li><a href="{{url('messages')}}">Messages</a></li>
                    <li><a href="{{url('settings')}}">Settings</a></li>
                @endif
            </ul>

                @foreach ($user->articles as $article)
                    <div class="media">
                        <a href="{{ url('article/'.$article->id) }}"><h4>{{$article->title}}</h4></a>
                    </div>
                @endforeach

        </div>
    </div>
</div>
@endsection
