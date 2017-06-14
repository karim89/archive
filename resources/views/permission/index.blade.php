@extends('layouts.app')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading"><h2>Permission Listing</h2></div>
    <div class="panel-body">
        <a href="#" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#myModal" onClick="dataModal('{{ URL::to('permission/create')}}')">Add</a>
        <table class="table">
            <tr>
                <th width="5%">No</th>
                <th>Name</th>
                <th>Display Name</th>
                <th>Description</th>
                <th width="14%">Action</th>
            </tr>
            <?php $no =1; ?>
            @forelse($permission as $val)
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{$val->name}}</td>
                    <td>{{$val->display_name}}</td>
                    <td>{{$val->description}}</td>
                    <td>
                        <a href="#"  data-toggle="modal" data-target="#myModal" class="btn btn-warning btn-xs "  onClick="dataModal('{{ URL::to('permission/edit')}}/{{$val->id}}')" >Edit</a>
                        @if(count($val->role) == 0)
                            <a href="{{ URL::to('permission/destroy/'.$val->id)}}" class="btn btn-danger btn-xs pull-right" onclick= "return confirm('Are you sure ?')">Delete</a>
                        @endif
                    </td>
                </tr>    
            @empty
            @endforelse
        </table>
        <div class="pages">{!! str_replace('/?', '?', $permission->render()) !!}</div>
    </div>
</div>

@endsection
