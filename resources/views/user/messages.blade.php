@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-4" style="padding-bottom: 30px">
                <img src="{{ asset('storage/'.$user->avatar)}}" style="width: 150px;display: block;margin: 0 auto">
                <h3>{{$user->name}}</h3>
                @if(Auth::check()&&Auth::id()==$user->id)
                    <a href="{{ url('/settings') }}">Edit profile</a>
                @endif
                <hr>
                <p><a href="mailto:{{$user->email}}">{{$user->email}}</a></p>
                @if(!is_null($user->bio))
                    <p>{{ $user->bio }}</p>
                @endif
                @if(!is_null($user->site))
                    <a href="{{ $user->site }}">{{ $user->site }}</a>
                @endif
                <p>Joined on {{$user->created_at}}</p>
            </div>
            <div class="col-xs-12 col-md-8">
                <ul class="nav nav-tabs">
                    <li><a href="{{ url('user/'.$user->id) }}">Articles</a></li>
                    <li class="active"><a href="#">Messages</a></li>
                    <li><a href="{{ url('settings') }}">Settings</a></li>
                </ul>

                <div>

                </div>

            </div>
        </div>
    </div>
@endsection