@extends('layouts.app')
@section('content')
<div class="panel panel-default container">
    <div class="panel-heading">Dashboard</div>
    <div class="panel-body">
        <div class="col-md-12">
            <div class="col-md-8">
                <h2>Web Archive {{isset($_GET['url']) ? $_GET['url'] : ''}}</h2>
            </div>
            <div class="col-md-4 pull-right">
                <form class="app-header-search" action="" method="get">        
                    <input type="text" name="url" class='form-control' placeholder="search url" value="{{isset($_GET['url']) ? $_GET['url'] : ''}}">
                </form>
            </div>
        </div>
        @role('admin')
            @if(isset($_GET['url']))
                <table id= "archive" class="table">
                    <thead>
                        <th>No</th>
                        <th>Timestamp</th>
                        <th>Original</th>
                    </thead>
                    <tbody></tbody>
                </table>
                <div id='message'></div>
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div id="origin"></div>
                        </div>
                    </div>
                </div>
                <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
                <script>
                    $(function() {
                        $('#message').html('<center><b>Loading........</b></center>');
                        $.getJSON('http://web.archive.org/cdx/search/cdx?url={{$_GET['url']}}&output=json', function (data) {
                            var tr;
                            for (var i = 0; i < data.length; i++) {
                                if( i > 0) {
                                    tr = $('<tr/>');
                                    var timestamp = data[i][1];
                                    var year = parseInt(timestamp.substr(0, 4), 10);
                                    var month = parseInt(timestamp.substr(4, 2), 10);
                                    var day = parseInt(timestamp.substr(6, 2), 10);
                                    var horse = parseInt(timestamp.substr(8, 2), 10);
                                    var menit = parseInt(timestamp.substr(10, 2), 10);
                                    var second = parseInt(timestamp.substr(12, 2), 10);
                                    var date = new Date(year, month - 1, day, horse, menit, second);
                                    tr.append("<td>" + i + "</td>");
                                    tr.append("<td> <a href='#'  data-toggle='modal' class='modal-origin' data-target='#myModal'  onClick='dataModal(\"{{ URL::to('origin')}}?timestamp="+timestamp+"&origin="+data[i][2]+"\")'>"+date+"</a> </td>");
                                    tr.append("<td>" + data[i][2] + "</td>");
                                    $('#archive').append(tr);
                                    $('#message').html('');
                                }
                            }
                            if(i == 0){
                                $('#message').html('<center><b> Data Not Nound.</b></center>');
                            }
                        });
                    });
                    function dataModal(url)
                    {   
                        $("#origin").html( "" );
                        $.ajax({
                             type: "GET",
                             url: url,
                             cache: false,
                             success: function(html) {
                             $("#origin").html( html );
                             }
                        });
                    }
                </script>
            @endif
        @endrole
    </div>
</div>  
@endsection
