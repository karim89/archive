@extends('layouts.app')

@section('content')
    <div class="app-heading app-heading-bordered app-heading-page">                        
        <div class="title">
            <h1>Add Website / URL / Domain</h1>
            <p>Information about New harvest website / URL / Domain to {{isset($metadata) ? 'Edit' : 'Add'}}</p>
        </div>               
        <!--
        <div class="heading-elements">
            <a href="#" class="btn btn-danger" id="page-like"><span class="app-spinner loading"></span> loading...</a>
            <a href="https://themeforest.net/item/boooya-revolution-admin-template/17227946?ref=aqvatarius&license=regular&open_purchase_for_item_id=17227946" class="btn btn-success btn-icon-fixed"><span class="icon-text">$24</span> Purchase</a>
        </div>
        -->
    </div>
    <div class="app-heading-container app-heading-bordered bottom">
        <ul class="breadcrumb">
            <li><a href="#"> Dashboard </a></li>
            <li><a href="#"> Website / URL / Domain </a></li>
            <li class="active"> {{isset($metadata) ? 'Edit' : 'Add'}} Website / URL / Domain </li>
        </ul>
    </div>
    <!-- END PAGE HEADING -->
    
    <!-- START PAGE CONTAINER -->
    <div class="container">
        
        <div class="row">
            <div class="col-md-8">
                
                <div class="block block-condensed">
                    <div class="app-heading app-heading-small">                                        
                        <div class="title">
                            <h2> Website Screenshot </h2>
                            <p> Latest Screenshot :  </p>
                        </div>
                    </div>
                    
                    <div class="block-content" >
                        <div id='prtsc'>
                            @if(isset($metadata))
                                @if($metadata->path)
                                    <img src="{{URL::to($metadata->path)}}" class="col-md-12">
                                @endif
                            @endif
                        </div>                                                                                
                        
                        <!-- <img src="assets/images/website-screenshot/kbs.png" style="width: 100%;max-height: 686px;"> -->
                        
                    </div>                                    
                </div>
                
            </div>
            <div class="col-md-4">
                
                <div class="block block-condensed">
                    <div class="app-heading app-heading-small">                                        
                        <div class="title">
                            <h3> Ministry / Organization Name </h3>
                            <p>Detailed Website Information</p>
                        </div>                 
                        <div class="heading-elements">
                            <button class="btn btn-default btn-icon"><span class="fa fa-pencil"></span></button>
                        </div>
                    </div>
                    @if(isset($metadata))
                        {!! Form::model($metadata, array('url'=> URL::to('website/update/'.$metadata->id), 'class'=>'form-horizontal', 'enctype' => 'multipart/form-data')) !!}
                    @else
                        {!! Form::open(array('url' => 'website/store', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data')) !!}
                    @endif
                    <table class="table table-bordered margin-bottom-0">                                        
                        <tbody>
                            <tr>
                                <td width="40%" class="text-bold"> Website Name (BM)<font color='red'>*</font></td>
                                <td> 
                                    {!! Form::text('title_bm', null, array('class'=>'form-control', 'required'=>'', 'id' => 'title_bm', 'autocomplete' => 'off', "oninvalid" => "this.setCustomValidity('Required.')", "oninput" => "setCustomValidity('')")) !!}
                                </td>                                               
                            </tr>
                            <tr>
                                <td width="40%" class="text-bold"> Website Name (Eng)<font color='red'>*</font></td>
                                <td> 
                                    {!! Form::text('title_eng', null, array('class'=>'form-control', 'required'=>'', 'id' => 'title_eng', 'autocomplete' => 'off', "oninvalid" => "this.setCustomValidity('Required.')", "oninput" => "setCustomValidity('')")) !!} 
                                </td>                                              
                            </tr>  
                            <tr>
                                <td width="40%" class="text-bold">Website URL <font color='red'>*</font><font color='red'></td>
                                <td> 
                                    {!! Form::text('url', null, array('class'=>'form-control', 'required'=>'', 'id' => 'url', 'autocomplete' => 'off', "oninvalid" => "this.setCustomValidity('Required.')", "oninput" => "setCustomValidity('')")) !!}     
                                    <a href="#"  class='btn btn-default btn-sm pull-right'   onClick="prtsc()">Screenshot URL</a>
                                 </td>                                                
                            </tr>                                            
                            <tr>
                                <td class="text-bold"> Discription (BM)</td>
                                <td>
                                    {!! Form::textarea('description_bm', null, array('class'=>'form-control')) !!}
                                </td>                                                
                            </tr>                                           
                            <tr>
                                <td class="text-bold"> Discription (Eng)</td>
                                <td>
                                    {!! Form::textarea('description_eng', null, array('class'=>'form-control')) !!}
                                </td>                                                
                            </tr> 
                            <tr>
                                <td class="text-bold"> Branch Code</td>
                                <td> 
                                    {!! Form::select('location_id', $location, null, array('class'=>'form-control')) !!}
                                </td> 
                            </tr>    
                            <tr>
                                <td class="text-bold"> Source Code</td>
                                <td> 
                                    {!! Form::select('source_id', $source, null, array('class'=>'form-control')) !!}
                                </td> 
                            </tr>                             
                            <tr>
                                <td class="text-bold">Languange</td>
                                <td> 
                                    {!! Form::select('language_id', $language, null, array('class'=>'form-control')) !!}
                                </td> 
                            </td> 
                            </tr>                                            
                            <tr>
                                <td class="text-bold"> Category </td>
                                <td> 
                                    {!! Form::select('category_id', $category, null, array('class'=>'form-control')) !!}
                                </td> 
                            </tr>                                            
                            <tr>
                                <td class="text-bold"> Subcategory </td>
                                <td> 
                                    {!! Form::select('subcategory_id', $subcategory, null, array('class'=>'form-control')) !!}
                                </td> 
                            </tr> 
                            <tr>
                                <td class="text-bold" colspan="2" id='submit'> <button type="submit" class="btn btn-success btn-icon-fixed" style="width: 100%"><span class="icon-arrow-up-circle"></span> Add Website </button> </td>
                            </tr>                                     
                        </tbody>
                    </table>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script>
    @if(!isset($metadata))
        $('#submit').hide();
    @endif
    function prtsc(url)
    {   
        $("#prtsc").html( "<p align='cernter'><b>Loading.......</b></p>" );
        var id = $("#url").val();
        $.ajax({
             type: "GET",
             url: "{{ URL::to('website/prtsc')}}",
             data: "url="+id,
             cache: false,
             success: function(html) {
             $("#prtsc").html( html );
             $('#submit').show();
             }
        });
    }
</script>
@endpush