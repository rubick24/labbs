@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h4 style="font-family: 'Microsoft YaHei UI',sans-serif">邮件已发送 请前往您的邮箱激活账号！</h4>
                    <a href="{{ url('/') }}">返回主页</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
