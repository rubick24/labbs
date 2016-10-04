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
                    <li><a href="{{ url('user/'.$user->id) }}">Articles</a></li>
                    <li class="active"><a href="#">Messages</a></li>
                    <li><a href="{{ url('settings') }}">Settings</a></li>
                </ul>

                <div class="col-md-12">
                    <br>
                    @foreach($messages[0] as $message)
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <p>from <a href="{{ url('user/'.$message['sender_id'] ) }}"> {{\App\Message::find( $message['id'])->sender->name}} </a> at {{ $message['created_at'] }}</p>
                                <b>{{ $message['content'] }}</b>
                            </div>
                        </div>
                    @endforeach
                    @foreach($messages[1] as $message)
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <p>from <a href="{{ url('user/'.$message['sender_id'] ) }}"> {{\App\Message::find( $message['id'])->sender->name}} </a> at {{ $message['created_at'] }}</p>
                                <p>{{ $message['content'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
@endsection