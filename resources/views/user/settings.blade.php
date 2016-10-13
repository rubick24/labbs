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
                    <li><a href="{{ url('messages') }}">Messages</a></li>
                    <li class="active"><a href="#">Settings</a></li>
                </ul>

                <div class="col-md-12">
                    <br>
                    <form class="form-inline" action="{{ url('user/'.Auth::id().'/avatar') }}" method="POST"  enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <button class="file-upload btn btn-default" style="display:inline-block; width:130px; height:40px;border-radius: 4px; position:relative; overflow:hidden;">
                            Select an image
                            <input type="file" name="avatar" accept="image/*" style="position:absolute; right:0; top:0; font-size:100px; opacity:0; filter:alpha(opacity=0);">
                        </button>
                        <button class="btn btn-default" type="submit">修改头像</button>
                    </form>
                    <form action="{{ url('user/'.Auth::id().'/update') }}" method="POST"  enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <div class="form-group" style="padding-top: 20px">
                            <label for="name">Name</label>
                            <input id="name" name="name" class="form-control" value="{{ $user->name }}">
                            <label for="bio">Bio</label>
                            <textarea id="bio" name="bio" class="form-control" placeholder="Tell a little about yourself">@if(!is_null($user->bio)){{ $user->bio }}@endif</textarea>
                            <label for="url">Url</label>
                            <input id="url" name="url" class="form-control" value="@if(!is_null($user->site)){{ $user->site }}@endif">
                        </div>
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>保存失败</strong> 输入不符合要求<br><br>
                                {!! implode('<br>', $errors->all()) !!}
                            </div>
                        @endif
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Update</button>
                        </div>
                    </form>
                </div>


            </div>
        </div>
    </div>
@endsection