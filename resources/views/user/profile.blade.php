@extends('layouts.app')
@section('content')
<div class="col-md-7">
    <div class="panel panel-default">
        <div class="panel-heading"><h2>Profile</h2></div>
        <div class="panel-body">
            {!! Form::model($user, array('url'=> URL::to('#'), 'class'=>'form-horizontal', 'enctype' => 'multipart/form-data')) !!}
                <div class="row">
                    <div class="form-group  col-md-12 ">
                        <label class="col-md-4 control-label">Name <font color='red'>*</font></label>
                        <div class="col-md-8">
                            {!! Form::text('name', null, array('class'=>'form-control', 'required'=>'', 'id' => 'name', 'autocomplete' => 'off', 'readonly' => '', "oninvalid" => "this.setCustomValidity('Required.')", "oninput" => "setCustomValidity('')")) !!}
                        </div>
                    </div>
                    <div class="form-group  col-md-12 ">
                        <label class="col-md-4 control-label">Birtdate <font color='red'>*</font></label>
                        <div class="col-md-8">
                            {!! Form::text('birtdate', isset($user) ? $user->birtdate ? date("d-m-Y", strtotime($user->birtdate)) : null : null, array('class'=>'form-control  date', 'required'=>'', 'id' => 'birtdate', 'autocomplete' => 'off', 'readonly' => '', "oninvalid" => "this.setCustomValidity('Required.')", "oninput" => "setCustomValidity('')")) !!}
                        </div>
                    </div>
                    <div class="form-group  col-md-12 ">
                        <label class="col-md-4 control-label">Gender <font color='red'>*</font></label>
                        <div class="col-md-8">
                            {!! Form::text('gender_id', isset($user) ? $user->gender ? $user->gender->code : null : null, array('class'=>'form-control', 'required'=>'', 'id' => 'gender_id', 'autocomplete' => 'off', 'readonly' => '', "oninvalid" => "this.setCustomValidity('Required.')", "oninput" => "setCustomValidity('')")) !!}
                        </div>
                    </div>
                    <div class="form-group  col-md-12 ">
                        <label class="col-md-4 control-label">Year <font color='red'>*</font></label>
                        <div class="col-md-8">
                            {!! Form::text('year', null, ['class' => 'form-control', 'readonly' => '']) !!}
                        </div>
                    </div>
                    <div class="form-group  col-md-12 ">
                        <label class="col-md-4 control-label">Email <font color='red'>*</font></label>
                        <div class="col-md-8">
                            {!! Form::email('email', null, array('class'=>'form-control', 'required'=>'', 'id' => 'email', 'autocomplete' => 'off', 'readonly' => '')) !!}
                        </div>
                    </div>
                    <div class="form-group  col-md-12 ">
                        <label class="col-md-4 control-label">Number <font color='red'>*</font></label>
                        <div class="col-md-8">
                            {!! Form::text('number', null, array('class'=>'form-control', 'required'=>'', 'id' => 'number', 'autocomplete' => 'off', 'readonly' => '', "oninvalid" => "this.setCustomValidity('Required.')", "oninput" => "setCustomValidity('')")) !!}
                        </div>
                    </div>
                    <div class="form-group  col-md-12 ">
                        <label class="col-md-4 control-label">Researcher Number </label>
                        <div class="col-md-8">
                            {!! Form::text('researcher_number', null, array('class'=>'form-control', 'id' => 'researcher_number', 'autocomplete' => 'off', 'readonly' => '')) !!}
                        </div>
                    </div>
                    <div class="form-group  col-md-12 ">
                        <label class="col-md-4 control-label">Mykad <font color='red'>*</font></label>
                        <div class="col-md-8">
                            {!! Form::text('mykad', null, array('class'=>'form-control', 'required'=>'', 'id' => 'mykad', 'autocomplete' => 'off', 'readonly' => '', "oninvalid" => "this.setCustomValidity('Required.')", "oninput" => "setCustomValidity('')")) !!}
                        </div>
                    </div>
                    <div class="form-group  col-md-12 ">
                        <label class="col-md-4 control-label">Username <font color='red'>*</font></label>
                        <div class="col-md-8">
                            {!! Form::text('username', null, array('class'=>'form-control', 'required'=>'', 'id' => 'username', 'autocomplete' => 'off', 'readonly' => '', "oninvalid" => "this.setCustomValidity('Required.')", "oninput" => "setCustomValidity('')")) !!}
                        </div>
                    </div>
                    <div class="form-group  col-md-12 ">
                        <label class="col-md-4 control-label">Role</label>
                        <div class="col-md-8">
                            {!! Form::select('role_id[]',  $role, isset($user) ? $user->role->pluck('role_id') : null, array('class'=>'form-control', 'readonly' => '', 'multiple'=>'multiple')) !!}
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<div class="col-md-5">
    <div class="panel panel-default">
        <div class="panel-heading"><h2>Avatar</h2></div>
        <div class="panel-body">
            {!! Form::model($user, array('url'=> URL::to('save-avatar'), 'class'=>'form-horizontal', 'enctype' => 'multipart/form-data')) !!}
                <div class="row">
                    @if($user->avatar)
                        <img src='{{$user->avatar->path }}' class="col-md-12 img-thumbnail">
                    @endif
                    <div class="form-group  col-md-12 ">
                        <div class="col-md-8">
                            {!! Form::file('image', null, array('class'=>'form-control', 'required'=>'', 'id' => 'file', 'autocomplete' => 'off', "oninvalid" => "this.setCustomValidity('Required.')", "oninput" => "setCustomValidity('')")) !!}
                        </div>
                        <div class="col-md-4"><button type="submit" name="save" class="btn btn-primary pull-right btn-sm" value="save">Upload</button></div>
                    </div>
                    
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
