@extends('layouts.app')

@section('content')
    <div class="app-heading app-heading-bordered app-heading-page">                        
        <div class="title">
            <h1>Add Website / URL / Domain</h1>
            <p>Information about New harvest website / URL / Domain to Add</p>
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
            <li class="active"> Add Website / URL / Domain </li>
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
                        <div id='prtsc'></div>                                                                                
                        
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
                    <table class="table table-bordered margin-bottom-0">                                        
                        <tbody>
                            <tr>
                                <td width="40%" class="text-bold"> Website Name </td>
                                <td> <input type="text" class="form-control" placeholder="Insert Website Name"> </td>                                                
                            </tr>  
                            <tr>
                                <td width="40%" class="text-bold">Website URL</td>
                                <td> <input type="text" id='url' name="url" class="form-control" placeholder="Insert Website URL">
                                <!-- <a href='#'   >Screenshot URL</a> -->
                                <button class='btn btn-default btn-sm pull-right'   onClick="prtsc()">Screenshot URL</button>
                                 </td>                                                
                            </tr>                                            
                            <tr>
                                <td class="text-bold"> Discription </td>
                                <td>
                                <textarea class="form-control" rows="10"></textarea>
                                </td>                                                
                            </tr> 
                            <tr>
                                <td class="text-bold"> Branch Code</td>
                                <td> <input type="text" class="form-control" placeholder="Insert Branch Code"> </td> 
                            </tr>    
                            <tr>
                                <td class="text-bold"> Source Code</td>
                                <td> <input type="text" class="form-control" placeholder="Insert Branch Code"> </td> 
                            </tr>                             
                            <tr>
                                <td class="text-bold">Languange</td>
                                <td> 
                                            <div class="form-group">                                                                
                                                <select class="bs-select">
                                                    <option>Select Language </option>
                                                    <option>1</option>  
                                                    <option>2</option>                                    
                                                </select>
                                            </div> 
                                </td> 
                            </tr>                                            
                            <tr>
                                <td class="text-bold"> Category </td>
                                <td> 
                                            <div class="form-group">                                                                
                                                <select class="bs-select">
                                                    <option>Select Catagory </option>
                                                    <option>1</option>  
                                                    <option>2</option>                                    
                                                </select>
                                            </div> 
                                </td> 
                            </tr>                                            
                            <tr>
                                <td class="text-bold"> Subcategory </td>
                                <td> 
                                            <div class="form-group">                                                                
                                                <select class="bs-select">
                                                    <option>Select Subcatagory </option>
                                                    <option>1</option>  
                                                    <option>2</option>                                    
                                                </select>
                                            </div> 
                                </td> 
                            </tr> 
                            <tr>
                                <td class="text-bold" colspan="2"> <button class="btn btn-success btn-icon-fixed" style="width: 100%"><span class="icon-arrow-up-circle"></span> Add Website </button> </td>
                            </tr>                                     
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    function prtsc(url)
    {   
        $("#prtsc").html( "<p align='cernter'><b>Loading.......</b></p>" );
        var id = $("#url").val();
        $.ajax({
             type: "GET",
             url: "{{ URL::to('prtsc')}}",
             data: "url="+id,
             cache: false,
             success: function(html) {
             $("#prtsc").html( html );
             }
        });
    }
</script>