@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">发布公告</div>
                <div class="panel-body">
                    <form action="{{ url('/owner/sendMessage') }}" method="post">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <textarea name="content" title="content" placeholder="Words here..." class="form-control" style="resize: vertical;min-height: 250px"></textarea>
                        </div>
                        <div class="form-group">
                            <a href="{{url('/owner')}}" class="btn btn-default">返回</a>
                            <button class="btn btn-primary pull-right" type="submit">发布</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
