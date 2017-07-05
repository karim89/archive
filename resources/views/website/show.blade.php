@extends('layouts.app')

@section('content')
<div class="app-heading app-heading-bordered app-heading-page">                        
    <div class="title">
        <h1>Website / URL / Domain</h1>
        <p>Information about the harvest website / URL / Domain </p>
    </div>  
</div>
<div class="app-heading-container app-heading-bordered bottom">
    <ul class="breadcrumb">
        <li><a href="#"> Dashboard </a></li>
        <li><a href="#"> Website Listing </a></li>
        <li class="active"> Website / URL / Domain </li>
    </ul>
</div>
<div class="col-md-8">
                                
    <div class="block block-condensed">
        <div class="app-heading app-heading-small">                                        
            <div class="title">
                <h2> Website Screenshot </h2>
                <p> Latest Screenshot : {{date("M d, Y h-i-s", strtotime($metadata->updated_at))}}</p>
            </div>
        </div>
        
        <div class="block-content">
            @if($metadata->path)
                <img src="{{URL::to($metadata->path)}}" class="col-md-12">
            @endif
            
        </div>                                    
    </div>
    
    <div class="block block-condensed">
        <div class="app-heading app-heading-small">                                        
            <div class="title">
                <h2>Harvest Listing Information</h2>
                <p>List of Harvest Information & Status</p>
            </div>           
            <div class="heading-elements">
                <button class="btn btn-default btn-icon-fixed" onClick="getItem()"><span class="fa fa-refresh"></span> Load more</button>
            </div>
        </div>
        
        <table class="table table-striped" id='harvest'>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Accession No</th>
                    <th>Date & Time</th>
                    <th>Size(MB)</th>
                    <th>Download</th>
                    <th>Status</th> 
                    <th>View</th>                                                     
                </tr>
            </thead>
            <tbody id='item'></tbody>
        </table>

        <div id='message'></div>
        <div id='pagination' class="pull-right"></div>
        
    </div>
    
</div>
<div class="col-md-4">
    
    <div class="block block-condensed">
        <div class="app-heading app-heading-small">                                        
            <div class="title">
                <h3> {{$metadata->title_bm}} <br> <i>{{$metadata->title_eng}} </h3>
                <p>Detailed Website Information</p>
            </div>                 
            <div class="heading-elements">
                <a href="{{URL::to('website/edit/'.$metadata->id)}}" class="btn btn-default btn-icon"><span class="fa fa-pencil"></span></a>
            </div>
        </div>
        <table class="table table-bordered margin-bottom-0">                                        
            <tbody>
                <tr>
                    <td width="40%" class="text-bold">Website URL</td>
                    <td> {{$metadata->url}} </td>                                                
                </tr>                                            
                <tr>
                    <td class="text-bold"> Discription </td>
                    <td>{{$metadata->description_bm}}<br>{{$metadata->description_eng}}</td>                                                
                </tr> 
                <tr>
                    <td class="text-bold"> Branch Code</td>
                    <td> {{$metadata->location ? $metadata->location->code : ''}} </td>
                </tr>    
                <tr>
                    <td class="text-bold"> Source Code</td>
                    <td> {{$metadata->source ? $metadata->source->code : ''}} </td>
                </tr>                             
                <tr>
                    <td class="text-bold">Languange</td>
                    <td> {{$metadata->language ? $metadata->language->code : ''}} </td>
                </tr>                                            
                <tr>
                    <td class="text-bold"> Category </td>
                    <td> {{$metadata->category ? $metadata->category->code : ''}} </td>
                </tr>                                            
                <tr>
                    <td class="text-bold"> Subcategory </td>
                    <td> {{$metadata->subcategory ? $metadata->subcategory->code : ''}} </td>
                </tr> 
                <tr>
                    <td class="text-bold" colspan="2"> <button class="btn btn-success btn-icon-fixed" style="width: 100%"><span class="icon-arrow-up-circle"></span> Harvest Now </button> </td>
                </tr>                                     
            </tbody>
        </table>
    </div><!---->
    
    <div class="block block-condensed">
        <div class="app-heading app-heading-small">                                        
            <div class="title">
                <h3> Auto Harvest Setting </h3>
                <p> Set Auto harvest Website by Month / by Day </p>
            </div>                 
            <div class="heading-elements">
                <button class="btn btn-default btn-icon"><span class="fa fa-pencil"></span></button>
            </div>
        </div>
        <table class="table table-bordered margin-bottom-0">                                        
            <tbody>
                <tr>
                    <td width="40%" class="text-bold">By Month</td>
                    <td> 
                                <div class="form-group">                                                                
                                    <select class="bs-select">
                                        <option>Select by Month</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>                                        
                                        <option>5</option> 
                                        <option>6</option>
                                        <option>7</option>
                                        <option>8</option>
                                        <option>9</option>                                        
                                        <option>10</option>  
                                        <option>11</option>
                                        <option>12</option>                                     
                                    </select>
                                </div> 
                    </td>                                                
                </tr>                                            
                <tr>
                    <td class="text-bold"> By Day </td>
                    <td>
                                <div class="form-group">                                                                
                                    <select class="bs-select">
                                        <option>Select by Day</option>
                                        <option>5</option>
                                        <option>10</option>
                                        <option>15</option>
                                        <option>20</option> 
                                        <option>25</option>                                  
                                    </select>
                                </div> 
                    </td>                                                
                </tr>                                                                                       
                <tr>
                    <td class="text-bold" colspan="2"> <button class="btn btn-success btn-icon-fixed" style="width: 100%"><span class="icon-arrow-up-circle"></span> Save Setting </button> </td>
                </tr>                                            
            </tbody>
        </table>
    </div><!---->

</div>
@endsection
@push('scripts')
<script>
        setTimeout(function(){
            getItem();
            return false;
        },10);
        setInterval( function () {
            getItem();
        }, 60000 );
        function getItem()
        {
            var param = {
                'ajax':'on',
                'page': "{{isset($_GET['page']) ? $_GET['page'] : ''}}"
            };
            let urlParameters = Object.keys(param).map((i) => i+'='+param[i]).join('&')
            
            $.getJSON('{{ URL::to("website/show/".Request::segment(3)."?")}}'+urlParameters, function (data) {
                var tr;
                var i = {{isset($_GET['page']) ? ($_GET['page'] - 1) * 10  : 0}};
                $('#item').html('');
                $.each(data.data.data, function(idx, elem){
                    i++;
                    tr = $('<tr/>');
                    tr.append("<td>" + i + "</td>");
                    tr.append("<td></td>");
                    tr.append("<td>" + elem.created_at + "</td>");
                    tr.append("<td></td>");
                    tr.append("<td></td>");
                    tr.append("<td></td>");
                    tr.append("<td></td>");
                    $('#harvest').append(tr);
                    $('#message').html('');
                });
                if(i == 0){
                    $('#message').html('<center><b> Data Not Nound.</b></center>');
                }
                $('#pagination').html(data['pagination']);
            });
        }
</script>
@endpush()