@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    You are logged in!
                </div>
            </div>
            @foreach ($articles as $article)
                <div class="panel panel-default">
                    <div class="panel-body">
                        <a href="{{ url('article/'.$article->id) }}" style="text-decoration: none">
                            <h3>{{ $article->title }}</h3>
                        </a>
                        <p>
                            <a href="{{url('/user/'.$article->user->name)}}">{{ $article->user->name }}</a>
                            <span style="color: #aaaaaa">posted at</span>
                            {{ $article->created_at }}
                        </p>
                    </div>
                </div>
            @endforeach

            </div>
        </div>
    </div>
</div>
@endsection
