@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>{{ $article->title }}</h3>
                    <p>
                        <a href="{{url('/user/'.$article->user->id)}}">{{ $article->user->name }}</a>
                        <span style="color: #aaaaaa">posted at</span>
                        {{ $article->created_at }}
                        <a class="pull-right" style="padding: 0 10px;font-size: 10px;text-decoration: none" href="{{ url('article/') }}">返回列表</a>
                    </p>
                    <p>
                        <span style="color: #aaaaaa;">category:</span>
                        <a href="{{ url('/category/'.$article->category->name) }}">{{ $article->category->name }}</a>
                        <span style="color: #aaaaaa;padding-left: 20px"> tags:</span>
                        @foreach($article->tags as $tag)
                            <span class="label label-info">{{ $tag->name }}</span>
                        @endforeach
                    </p>
                    @if(Auth::check()&&(Auth::id() ==$article->user_id||Auth::user()->hasRole('owner')||Auth::user()->hasRole('admin')))
                        <form action="{{ url('/article/'.$article->id) }}" method="POST" style="display: inline;">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-sm pull-right btn-default">Delete</button>
                        </form>
                        <br>
                    @endif
                    <hr>
                    <p>{!! $article->html() !!}</p>
                    <a style="padding: 0 10px;font-size: 10px;text-decoration: none" href="{{ url('article/') }}">返回列表</a>
                </div>
            </div>
            @foreach ($article->comments as $comment )
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="media">
                            <div class="media-left">
                                <a href="{{url('/user/'.$comment->user->id)}}">
                                    <img class="media-object" style="width: 80px" src="{{ asset('storage/'.$comment->user->avatar)}}">
                                </a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">{{$comment->user->name}}</h4>
                                <p><span style="color: #aaaaaa">posted at</span> {{ $comment->created_at }} </p>
                                {{ $comment->content }}
                            </div>
                            @if(Auth::check()&& (Auth::id() ==$comment->user->id||Auth::user()->hasRole('owner')||Auth::user()->hasRole('admin')))
                                <form action="{{ url('/comment/'.$comment->id) }}" method="POST" style="display: inline;">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-sm pull-right btn-default">Delete</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="media">
                        @if(Auth::guest())
                            <div class="media-left">
                                <a href="{{url('/login')}}">
                                    <img class="media-object" style="width: 80px" src="{{ asset('storage/avatar/default.svg')}}">
                                </a>
                            </div>
                            <div class="media-body">
                                <h4><a href="{{url('/login') }}">Sign in </a> to post a comment</h4>
                            </div>
                        @else
                            <div class="media-left">
                                <a href="{{url('/user/'.Auth::id())}}">
                                    <img class="media-object" style="width: 80px" src="{{ asset('storage/'.Auth::user()->avatar)}}">
                                </a>
                            </div>
                            <div class="media-body">
                                <h4>{{Auth::user()->name}}</h4>
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <strong>发表失败</strong> 输入不符合要求<br><br>
                                        {!! implode('<br>', $errors->all()) !!}
                                    </div>
                                @endif
                                <form action="{{ url('/comment') }}" method="POST">
                                    {!! csrf_field() !!}
                                    <input name="article" type="hidden" value="{{ $article->id }}">
                                    <textarea title="comment" name="comment" class="form-control" placeholder="post a comment here.." style="width: 100%;height: 120px;resize: none"></textarea>
                                    <div class="input-group pull-right" style="padding: 10px">
                                        <button class="btn btn-primary" type="submit">Post</button>
                                    </div>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
