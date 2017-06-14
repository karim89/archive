@extends('layouts.app')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading"><h2>Permission Listing</h2></div>
    <div class="panel-body">
        <a href="#" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#myModal" onClick="dataModal('{{ URL::to('role/create')}}')">Add</a>
        <table class="table">
            <tr>
                <th width="5%">No</th>
                <th>Name</th>
                <th>Display Name</th>
                <th>Description</th>
                <th>Permission</th>
                <th width="14%">Action</th>
            </tr>
            <?php $no =1; ?>
            @forelse($role as $val)
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{$val->name}}</td>
                    <td>{{$val->display_name}}</td>
                    <td>{{$val->description}}</td>
                    <td>
                        @foreach($val->permission as $per)
                            <span class="label label-default">{{$per->permission['display_name']}}</span>
                        @endforeach
                    </td>
                    <td>
                        <a href="#"  data-toggle="modal" data-target="#myModal" class="btn btn-warning btn-xs "  onClick="dataModal('{{ URL::to('role/edit')}}/{{$val->id}}')" >Edit</a>
                        @if(count($val->user) == 0)
                            <a href="{{ URL::to('role/destroy/'.$val->id)}}" class="btn btn-danger btn-xs pull-right" onclick= "return confirm('Are you sure ?')">Delete</a>
                        @endif
                    </td>
                </tr>    
            @empty
            @endforelse
        </table>
        <div class="pages">{!! str_replace('/?', '?', $role->render()) !!}</div>
    </div>
</div>

@endsection
