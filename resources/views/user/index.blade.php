@extends('layouts.app')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading"><h2>Permission Listing</h2></div>
    <div class="panel-body">
        <a href="#" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#myModal" onClick="dataModal('{{ URL::to('user/create')}}')">Add</a>
        <table class="table">
            <tr>
                <th width="5%">No</th>
                <th>Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th width="14%">Action</th>
            </tr>
            <?php $no =1; ?>
            @forelse($user as $val)
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{$val->name}}</td>
                    <td>{{$val->username}}</td>
                    <td>{{$val->email}}</td>
                    <td>
                        @foreach($val->role as $rol)
                            <span class="label label-default">{{$rol->role['display_name']}}</span>
                        @endforeach
                    </td>
                    <td>
                        <a href="#"  data-toggle="modal" data-target="#myModal" class="btn btn-warning btn-xs "  onClick="dataModal('{{ URL::to('user/edit')}}/{{$val->id}}')" >Edit</a>
                        @if(\Auth::user()->id != $val->id)
                            <a href="{{ URL::to('user/destroy/'.$val->id)}}" class="btn btn-danger btn-xs pull-right" onclick= "return confirm('Are you sure ?')">Delete</a>
                        @endif
                    </td>
                </tr>    
            @empty
            @endforelse
        </table>
        <div class="pages">{!! str_replace('/?', '?', $user->render()) !!}</div>
    </div>
</div>

@endsection
