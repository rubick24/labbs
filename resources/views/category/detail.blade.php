@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div >
                        <h4>
                            Category : {{ $category->name }} <span class="badge" style="font-family: 'Lato', sans-serif"> {{ $category->articles->count() }} </span>
                        </h4>
                        <a href="{{ url('/category') }}" class="pull-right"> 返回列表 </a>
                    </div>
                </div>
            </div>
            @foreach($category->articles as $article)
                <div class="panel panel-default">
                    <div class="panel-body">
                        <a href="{{ url('article/'.$article->id) }}" style="text-decoration: none">
                            <h3>{{ $article->title }}</h3>
                        </a>
                        <p>
                            <span style="color: #aaaaaa;">category:</span>
                            <a href="{{ url('/category/'.$article->category->name) }}">{{ $article->category->name }}</a>
                            <span style="color: #aaaaaa;padding-left: 20px"> tags:</span>
                            @foreach($article->tags as $tag)
                                <span class="label label-info">{{ $tag->name }}</span>
                            @endforeach
                        </p>
                        <p>
                            <a href="{{url('/user/'.$article->user_id)}}">{{ $article->user->name }}</a>
                            <span style="color: #aaaaaa">posted at</span>
                            {{ $article->created_at }}
                        </p>
                    </div>
                </div>

            @endforeach

        </div>
    </div>
</div>
@endsection
