@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    用户管理
                </div>
            </div>
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Avatar</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>profile</th>
                    <td>Create-post</td>
                    <td>Delete</td>
                </tr>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td><img src="{{ asset('storage/'.$user->avatar) }}" style="width: 28px;height: 28px"></td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td><a href="{{ url('user/'.$user->id) }}" target="_blank"><span class="glyphicon glyphicon-new-window"></span></a></td>
                        <td>
                            @if($user->can('create-post'))
                                <span class="glyphicon glyphicon-ok"></span>
                            @else
                                <button class="btn btn-info btn-sm">授权</button>
                            @endif
                        </td>
                        <td>
                            @if(!$user->hasRole('owner'))
                            <button class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span></button>
                            @endif
                        </td>
                    </tr>

                @endforeach
            </table>
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
