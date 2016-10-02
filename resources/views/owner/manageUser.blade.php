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
                    <td>Create-post</td>
                    <td>Delete</td>
                </tr>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td><img src="{{ asset('storage/'.$user->avatar) }}" style="width: 28px;height: 28px"></td>
                        <td><a href="{{ url('user/'.$user->id) }}" target="_blank">{{ $user->name }}</a></td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <form class="form-inline" action="{{ url('/owner/user/toggle') }}">
                                <input title="id" name="id" style="display: none" value="{{  $user->id }}">
                                    @if(!$user->hasRole('owner'))
                                        <button class="btn btn-sm" type="submit">
                                            @if($user->hasRole('member'))
                                                <span class="glyphicon glyphicon-ok"></span>
                                            @else
                                                <span class="glyphicon glyphicon-ban-circle"></span>
                                            @endif
                                        </button>
                                    @else
                                        <span class="glyphicon glyphicon-ok"></span>
                                    @endif

                            </form>
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
