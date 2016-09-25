@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>{{ $article->title }}</h3>
                    <p>
                        <a href="{{url('/user/'.$article->user->name)}}">{{ $article->user->name }}</a>
                        <span style="color: #aaaaaa">posted at</span>
                        {{ $article->created_at }}
                    </p>
                    <hr>
                    <p>{!! $article->html() !!}</p>
                    <a style="padding: 0 10px;font-size: 10px;text-decoration: none" href="{{ url('article/') }}">返回列表</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
