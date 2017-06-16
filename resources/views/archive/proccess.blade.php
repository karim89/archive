@extends('layouts.app')
@section('content')

<div class="panel panel-default">
    <div class="panel-heading"><h2>Proccess Archiving</h2></div>
    <div class="panel-body">
        <table id= "archive"  class="table">
            <thead>
                <th>No</th>
                <th>Name</th>
                <th>Url</th>
                <th>Status</th>
                <th width='5%'>Action</th>
            </thead>
            
                
            <tbody id='item'></div>
            </tbody>
        </table>
        <div id='message'></div>
        <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
        <script>
            $(function() {
                setTimeout(function(){
                    getItem();
                    return false;
                },10);
                setInterval( function () {
                    getItem();
                }, 90000 );
                function getItem()
                {
                    $.getJSON("{{ URL::to('archive/list-proccess')}}", function (data) {
                        var tr;
                        var i = 0;
                        $('#item').html('');
                        $.each(data, function(idx, elem){
                            i++;
                            var status;
                            var action = '';
                            if(elem.done_time == null){
                                if(elem.run_time == null){
                                    status = 'Waiting';
                                }else if(elem.run_time != null && elem.pause_time == null && elem.resume_time != null){
                                        status = 'Waiting';
                                }else if(elem.run_time != null && elem.pause_time == null && elem.resume_time == null){
                                    status = 'Proccess Archiving';
                                    action = "<a href='{{URL::to('/')}}/archive/pause/"+elem.id+"' class='btn btn-default btn-sm'>Paus</a>";
                                }else if(elem.run_time != null && elem.pause_time != null){
                                    status = 'Pause';
                                    action = "<a href='{{URL::to('/')}}/archive/resume/"+elem.id+"' class='btn btn-default btn-sm'>Resume</a>";
                                }
                            }else{
                                status = 'Finish';
                            }
                            tr = $('<tr/>');
                            tr.append("<td>" + i + "</td>");
                            tr.append("<td>" + elem.name + "</td>");
                            tr.append("<td>" + elem.url + "</td>");
                            tr.append("<td>" + status + "</td>");
                            tr.append("<td>" + action + "</td>");
                            $('#archive').append(tr);
                            $('#message').html('');
                        });
                        if(i == 0){
                            $('#message').html('<center><b> Data Not Nound.</b></center>');
                        }
                    });
                }
            });
        </script>
        
    </div>
</div>  
@endsection
