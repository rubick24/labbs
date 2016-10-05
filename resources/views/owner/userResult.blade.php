@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">用户管理</div>

                <div class="panel-body">
                    <form method="get" action="{{ url('/owner/user/search') }}" role="search">
                        <div class="form-group">
                            <div class="input-group">
                                <input name="text" type="text" class="form-control" placeholder="Search User"  autocomplete="off">
                                <span class="input-group-btn">
                                <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                            </span>
                            </div>
                        </div>
                    </form>
                    <div class="form-group">
                        <a href="{{ url('owner/user') }}" class="btn btn-default">所有用户</a>
                        <a href="{{ url('owner/user/unratified') }}" class="btn btn-default">未批准</a>
                        <a href="{{ url('owner/user/admin') }}" class="btn btn-default">管理员</a>
                    </div>

                </div>
            </div>
            <div class="container-fluid">
                <h3 style="font-family: 'Microsoft YaHei UI Light',sans-serif; ">Result for {{ $data['s'] }}</h3> <a class="pull-right" href="{{ url('owner/user') }}">返回列表</a>
            </div>

            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Avatar</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Create-post</th>
                    <th>Admin</th>
                    <th>Delete</th>
                </tr>
                @foreach($data['u'] as $u)
                    <?php
                        $user = App\User::find($u->id)
                    ?>
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td><img src="{{ asset('storage/'.$user->avatar) }}" style="width: 28px;height: 28px"></td>
                            <td><a href="{{ url('user/'.$user->id) }}" target="_blank">{{ $user->name }}</a></td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <form class="form-inline" action="{{ url('/owner/user/toggle') }}">
                                    <input title="id" name="id" style="display: none" value="{{  $user->id }}">
                                    @if(!$user->hasRole('owner'))
                                        @if($user->hasRole('member'))
                                            @if($user->hasRole('admin'))
                                                <button class="btn btn-sm btn-default disabled" type="submit">
                                                    <span class="glyphicon glyphicon-check"></span>
                                                </button>
                                            @else
                                                <button class="btn btn-sm btn-default" type="submit">
                                                    <span class="glyphicon glyphicon-check"></span>
                                                </button>
                                            @endif
                                        @else
                                            <button class="btn btn-sm btn-default" type="submit">
                                                <span class="glyphicon glyphicon-unchecked"></span>
                                            </button>
                                        @endif
                                    @else
                                        <span class="glyphicon glyphicon-check"></span>
                                    @endif

                                </form>
                            </td>
                            <td>
                                <form class="form-inline" action="{{ url('/owner/user/adminToggle') }}">
                                    <input title="id" name="id" style="display: none" value="{{  $user->id }}">
                                    @if(!$user->hasRole('owner'))
                                        @if($user->hasRole('admin'))
                                            <button class="btn btn-sm btn-default" type="submit">
                                                <span class="glyphicon glyphicon-check"></span>
                                            </button>
                                        @else
                                            @if($user->hasRole('member'))
                                                <button class="btn btn-sm btn-default" type="submit">
                                                    <span class="glyphicon glyphicon-unchecked"></span>
                                                </button>
                                            @else
                                                <button class="btn btn-sm btn-default disabled" type="submit">
                                                    <span class="glyphicon glyphicon-unchecked"></span>
                                                </button>
                                            @endif
                                        @endif
                                    @else
                                        <span class="glyphicon glyphicon-check"></span>
                                    @endif

                                </form>
                            </td>
                            <td>
                                @if(!$user->hasRole('owner'))
                                    <form action="{{ url('/owner/user/'.$user->id) }}" method="POST" style="display: inline;">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span></button>
                                    </form>
                                @endif
                            </td>
                        </tr>

                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection
