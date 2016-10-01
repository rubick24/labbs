@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div  class="thumbnail">
                                <a href="{{ url('/owner/user') }}" style="text-decoration: none;display: inline-flex;padding: 20px">
                                    <span style="font-size: 50px;display: inline-block;" class="glyphicon glyphicon-user"></span>
                                    <p style="display: inline-block;padding: 10px 20px 0 25px;font-size: 20px;font-family:'Microsoft YaHei UI',sans-serif">用户管理</p>
                                </a>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div  class="thumbnail">
                                <a href="{{ url('/owner/') }}" style="text-decoration: none;display: inline-flex;padding: 20px">
                                    <span style="font-size: 50px;display: inline-block;" class="glyphicon glyphicon-list-alt"></span>
                                    <p style="display: inline-block;padding: 10px 20px 0 25px;font-size: 20px;font-family:'Microsoft YaHei UI',sans-serif">文章管理</p>
                                </a>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="thumbnail">
                                <a href="{{ url('/owner/') }}" style="text-decoration: none;display: inline-flex;padding: 20px">
                                    <span style="font-size: 50px;display: inline-block;" class="glyphicon glyphicon-comment"></span>
                                    <p style="display: inline-block;padding: 10px 20px 0 25px;font-size: 20px;font-family:'Microsoft YaHei UI',sans-serif">发布公告</p>
                                </a>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="thumbnail">
                                <a href="{{ url('/owner/') }}" style="text-decoration: none;display: inline-flex;padding: 20px">
                                    <span style="font-size: 50px;display: inline-block;" class="glyphicon glyphicon-calendar"></span>
                                    <p style="display: inline-block;padding: 10px 20px 0 25px;font-size: 20px;font-family:'Microsoft YaHei UI',sans-serif">查看日志</p>
                                </a>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
