@extends('layouts.app')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading"><h2>Language Listing</h2></div>
    <div class="panel-body">
        <a href="#" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#myModal" onClick="dataModal('{{ URL::to('language/create')}}')">Add</a>
        <table class="table">
            <tr>
                <th width="5%">No</th>
                <th>Code</th>
                <th>Title Bm</th>
                <th>Title Eng</th>
                <th>Description Bm</th>
                <th>Description Eng</th>
                <th width="14%">Action</th>
            </tr>
            <?php $no =1; ?>
            @forelse($language as $val)
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{$val->code}}</td>
                    <td>{{$val->title_bm}}</td>
                    <td>{{$val->title_eng}}</td>
                    <td>{{$val->description_bm}}</td>
                    <td>{{$val->description_eng}}</td>
                    <td>
                        <a href="#"  data-toggle="modal" data-target="#myModal" class="btn btn-warning btn-xs "  onClick="dataModal('{{ URL::to('language/edit')}}/{{$val->id}}')" >Edit</a>
                        <a href="{{ URL::to('language/destroy/'.$val->id)}}" class="btn btn-danger btn-xs pull-right" onclick= "return confirm('Are you sure ?')">Delete</a>
                    </td>
                </tr>    
            @empty
            @endforelse
        </table>
        <div class="pages">{!! str_replace('/?', '?', $language->render()) !!}</div>
    </div>
</div>

@endsection
