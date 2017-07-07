@extends('layouts.app')
@section('content')
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="{{ URL::to('css/elfinder.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ URL::to('css/theme.css')}}">
<div class="app-heading app-heading-bordered app-heading-page">
    <div class="icon icon-lg">
        <span class="icon-laptop-phone"></span>
    </div>
    <div class="title">
        <h1>Malaysia Web Archiving</h1>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">File Manager</div>
    <div class="panel-body">
        <div id="elfinder"></div>

    </div>
</div>

        
@endsection
@push('scripts')
<script src="{{ URL::to('js/elfinder.min.js')}}"></script>

<!-- Extra contents editors (OPTIONAL) -->
<script src="{{ URL::to('js/extras/editors.default.js')}}"></script> 
<script type="text/javascript" charset="utf-8">
    // Documentation for client options:
    // https://github.com/Studio-42/elFinder/wiki/Client-configuration-options
    $(document).ready(function() {
        $('#elfinder').elfinder(
            // 1st Arg - options
            {
                cssAutoLoad : false,               // Disable CSS auto loading
                baseUrl : './',                    // Base URL to css/*, js/*
                url : '{{ URL::to("elFinder/connector?warc=".config('app.path_warc'))}}'  // connector URL (REQUIRED)
                // , lang: 'ru'                    // language (OPTIONAL)
            },
            // 2nd Arg - before boot up function
            function(fm, extraObj) {
                // `init` event callback function
                fm.bind('init', function() {
                    // Optional for Japanese decoder "extras/encoding-japanese.min"
                    delete fm.options.rawStringDecoder;
                    if (fm.lang === 'jp') {
                        fm.loadScript(
                            [ fm.baseUrl + 'js/extras/encoding-japanese.min.js' ],
                            function() {
                                if (window.Encoding && Encoding.convert) {
                                    fm.options.rawStringDecoder = function(s) {
                                        return Encoding.convert(s,{to:'UNICODE',type:'string'});
                                    };
                                }
                            },
                            { loadType: 'tag' }
                        );
                    }
                });
                // Optional for set document.title dynamically.
                var title = document.title;
                fm.bind('open', function() {
                    var path = '',
                        cwd  = fm.cwd();
                    if (cwd) {
                        path = fm.path(cwd.hash) || null;
                    }
                    document.title = path? path + ':' + title : title;
                }).bind('destroy', function() {
                    document.title = title;
                });
            }
        );
    });
</script>
@endpush 

