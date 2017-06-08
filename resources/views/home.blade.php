@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">Dashboard</div>

    <div class="panel-body">
        You are logged in!
        @role('admin')
            <p>This is visible to users with the admin role. Gets translated to 
            \Entrust::role('admin')</p>
        @endrole
    </div>
</div>
        
@endsection
