@extends('layouts.app')
@section('content')
<div class="panel panel-default">
    <div class="app-heading-container app-heading-bordered bottom">
        <ul class="breadcrumb">
            <li><a href="#">Dashboard</a></li> 
            <li class="active">Harvest</li>                                                    
            <li class="active">Website Listing</li>
        </ul>
    </div>
    <div class="panel-body">
        <a href="#" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#myModal" onClick="dataModal('{{ URL::to('website/create')}}')">Add</a>
        <table class="table">
            <tr>
                <th>Ministry / Organization</th>
                <th width="150">Website Status</th>
                <th width="150"></th>
            </tr>
            <?php $no =1; ?>
            @forelse($metadata as $val)
                <tr>
                    
                    <td>
                         <div class="contact contact-rounded contact-bordered contact-lg">
                            <img src="{{URL::to($val->source ? $val->source->logo ? $val->source->logo->path : '' : '')}}">
                            <div class="contact-container">
                                <a href="MWARC-website-info.html">{{$val->title_bm}} / <i>{{$val->title_eng}}</i></a>
                                <span>on {{date("M d, Y", strtotime($val->created_at))}}</span>
                            </div>
                        </div>
                    </td>
                    <td></td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-default btn-icon btn-clean dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="icon-cog"></span></button>
                            <ul class="dropdown-menu dropdown-left">
                                <li><a href="{{URL::to('website/show/'.$val->id)}}"><span class="icon-question-circle text-info"></span> Website Info</a></li> 
                                <li><a href="#"><span class="icon-arrow-up-circle text-warning"></span> Active</a></li> 
                                <li class="divider"></li>
                                <li><a href="#"><span class="icon-cross-circle text-danger"></span> Unactive</a></li> 
                            </ul>
                        </div>
                    </td>
                </tr>    
            @empty
            @endforelse
        </table>
        <div class="pages">{!! str_replace('/?', '?', $metadata->render()) !!}</div>
    </div>
</div>

@endsection
