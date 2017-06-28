@extends('layouts.app')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading"><h2>Change Password</h2></div>
        <div class="panel-body">
            {!! Form::open(array('url' => 'save-password', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data')) !!}
                <div class="row">
                    <div class="form-group  col-md-12 ">
                        <label class="col-md-3 control-label">Current Password <font color='red'>*</font></label>
                        <div class="col-md-6">
                            <input type="password" name="current" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group  col-md-12 ">
                        <label class="col-md-3 control-label">New Password <font color='red'>*</font></label>
                        <div class="col-md-6">
                            <input type="password" name="password" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group  col-md-12 ">
                        <label class="col-md-3 control-label"> Confirmation Password <font color='red'>*</font></label>
                        <div class="col-md-6">
                            <input type="password" name="confirmation" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group col-md-12 ">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                            <button type="submit" name="save" class="btn btn-primary pull-right btn-sm" value="save">Submit</button>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
