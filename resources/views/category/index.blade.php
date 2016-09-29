@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Categories</div>
                <ul class="list-group">
                    @foreach($categorys as $category)
                        <li class="list-group-item">
                            <a href="{{ url('category/'.$category->name) }}">
                                <h4>{{ $category->name }} <span class="badge" style="font-family: 'Lato', sans-serif">{{ $category->articles->count() }}</span></h4>

                            </a>

                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
