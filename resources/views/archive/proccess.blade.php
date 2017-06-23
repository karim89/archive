@extends('layouts.app')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading"><h2>Proccess Archiving</h2></div>
    <div class="panel-body">
        <form class="form-horizontal">
            <div class="col-md-4">
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" name='q' id='q' class="form-control text-bold" placeholder="Keyword..." value="{{isset($_GET['q']) ? $_GET['q'] : ''}}">
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-default">Search</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
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
        <div id='pagination' class="pull-right"></div>
    </div>
</div>  
@endsection

@push('scripts')
<script>
    $(function() {
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
                'q': $('#q').val(),
                'page': "{{isset($_GET['page']) ? $_GET['page'] : ''}}"
            };
            let urlParameters = Object.keys(param).map((i) => i+'='+param[i]).join('&')
            
            $.getJSON('{{ URL::to("archive/proccess?")}}'+urlParameters, function (data) {
                var tr;
                var i = {{isset($_GET['page']) ? ($_GET['page'] - 1) * 10  : 0}};
                $('#item').html('');
                $.each(data.data.data, function(idx, elem){
                    i++;
                    var status;
                    var action = '';
                    var url = elem.url;
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
                        var created_at = elem.created_at;
                        created_at = created_at.replace('-', '');
                        created_at = created_at.replace('-', '');
                        created_at = created_at.replace(':', '');
                        created_at = created_at.replace(':', '');
                        created_at = created_at.replace(' ', '');
                        url = "<a href='{{URL::to('/')}}/archive/read/"+created_at+"/"+elem.url+"' >"+elem.url+"</a>";
                        // url = "<a href='{{URL::to('/')}}/archive/web/"+created_at+"?url="+elem.url+"' >"+elem.url+"</a>";
                        status = 'Finish';
                    }
                    tr = $('<tr/>');
                    tr.append("<td>" + i + "</td>");
                    tr.append("<td>" + elem.name + "</td>");
                    tr.append("<td>" + url + "</td>");
                    tr.append("<td>" + status + "</td>");
                    tr.append("<td>" + action + "</td>");
                    $('#archive').append(tr);
                    $('#message').html('');
                });
                if(i == 0){
                    $('#message').html('<center><b> Data Not Nound.</b></center>');
                }
                $('#pagination').html(data['pagination']);
            });
        }
    });
</script>
@endpush()
