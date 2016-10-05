@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Send Message</div>
                <div class="panel-body">
                    <form action="{{ url('/sendMessage') }}" method="post">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <h4>Send to <b> {{$user->name}}</b></h4>
                            <input name="id" title="id" value="{{ $user->id }}" style="display: none">
                        </div>
                        <div class="form-group">
                            <textarea name="content" title="content" placeholder="Words here..." class="form-control" style="resize: vertical;min-height: 200px"></textarea>
                        </div>
                        <div class="form-group">
                            <a href="{{url('/user/'.$user->id)}}" class="btn btn-default">Back</a>
                            <button class="btn btn-primary pull-right" type="submit">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
