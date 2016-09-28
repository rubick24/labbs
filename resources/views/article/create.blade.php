@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">New Article</div>

                <div class="panel-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>发表失败</strong> 输入不符合要求<br><br>
                            {!! implode('<br>', $errors->all()) !!}
                        </div>
                    @endif
                    <form action="{{ url('article') }}" method="POST">
                        {!! csrf_field() !!}
                        <input class="form-control" name="title" style="width: 100%" placeholder="Title of article" >

                        <div class="input-group" style="width: 100%;padding: 20px 0">
                            <textarea class="form-control" name="content" placeholder="Markdown is supported" style="width: 100%;height: 340px;resize: none"></textarea>
                        </div>
                        <div class="input-group" style="width: 100%;display: inline;padding: 20px 0">
                            <label>Category : </label>
                            <select class=<rol" name="cate" title="cate" >
                                @foreach($categorys as $category)
                                    <option value="{{$category->id}}" >{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="input-group" style="width: 100%;padding: 5px">
                            <a href="{{ url('/article') }}">cancel</a>
                            <button class="btn btn-primary pull-right" type="submit">Post</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
