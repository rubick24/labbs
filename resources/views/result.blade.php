@extends('layouts.app')

@section('content')
<div class="container" style="padding: 25px 0">

        <div class="col-md-10 col-md-offset-1">
            <div class="page-header">
                <h1>The results of  "{{ $data['s'] }}" </h1>
            </div>
            <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Users <span class="badge" style="background: #666">{{ count($data['u']) }}</span> </div>
                <ul class="list-group">
                    @foreach($data['u'] as $user)
                        <li class="list-group-item">
                            <a href="{{ url('/user/'.$user->id) }}" style="display: inline-flex">
                                <img src="{{ asset('storage/'.$user->avatar) }}" style="width: 30px;height: 30px">
                                <h4>{{ $user->name }}</h4>
                            </a>
                        </li>
                    @endforeach
                </ul>

            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Articles <span class="badge" style="background: #666">{{ count($data['a']) }}</span></div>
                <ul class="list-group">
                    @foreach($data['a'] as $article)
                        <li class="list-group-item">
                            <a href="{{ url('/article/'.$article->id) }}">{{$article->title}}</a>
                        </li>
                    @endforeach
                </ul>

            </div>
        </div>
    </div>

</div>
@endsection
