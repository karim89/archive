<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h2 class="modal-title" id="myModalLabel">Form User</h2>
</div>
<div class="modal-body">
	@if(isset($user))
		{!! Form::model($user, array('url'=> URL::to('user/update/'.$user->id), 'class'=>'form-horizontal', 'enctype' => 'multipart/form-data')) !!}
	@else
		{!! Form::open(array('url' => 'user/store', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data')) !!}
	@endif
	<div class="row">
		<div class="form-group  col-md-12 ">
            <label class="col-md-4 control-label">Name <font color='red'>*</font></label>
            <div class="col-md-8">
                {!! Form::text('name', null, array('class'=>'form-control', 'required'=>'', 'id' => 'name', 'autocomplete' => 'off', "oninvalid" => "this.setCustomValidity('Required.')", "oninput" => "setCustomValidity('')")) !!}
            </div>
        </div>
        <div class="form-group  col-md-12 ">
            <label class="col-md-4 control-label">Birtdate <font color='red'>*</font></label>
            <div class="col-md-8">
                {!! Form::text('birtdate', isset($user) ? $user->birtdate ? date("d-m-Y", strtotime($user->birtdate)) : null : null, array('class'=>'form-control  date', 'required'=>'', 'id' => 'birtdate', 'autocomplete' => 'off', "oninvalid" => "this.setCustomValidity('Required.')", "oninput" => "setCustomValidity('')")) !!}
            </div>
        </div>
        <div class="form-group  col-md-12 ">
            <label class="col-md-4 control-label">Gender <font color='red'>*</font></label>
            <div class="col-md-8">
                {!! Form::select('gender_id',  $gender, isset($user) ? $user->gender_id : null, array('class'=>'form-control', 'required'=>'', 'id' => 'gender_id', 'autocomplete' => 'off', "oninvalid" => "this.setCustomValidity('Required.')", "oninput" => "setCustomValidity('')")) !!}
            </div>
        </div>
        <div class="form-group  col-md-12 ">
            <label class="col-md-4 control-label">Year <font color='red'>*</font></label>
            <div class="col-md-8">
                {!! Form::selectYear('year', 2000, date('Y') + 2, isset($user) ? $user->year ? $user->year : date('Y') : date('Y'), ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group  col-md-12 ">
            <label class="col-md-4 control-label">Email <font color='red'>*</font></label>
            <div class="col-md-8">
                {!! Form::email('email', null, array('class'=>'form-control', 'required'=>'', 'id' => 'email', 'autocomplete' => 'off')) !!}
            </div>
        </div>
        <div class="form-group  col-md-12 ">
            <label class="col-md-4 control-label">Number <font color='red'>*</font></label>
            <div class="col-md-8">
                {!! Form::text('number', null, array('class'=>'form-control', 'required'=>'', 'id' => 'number', 'autocomplete' => 'off', "oninvalid" => "this.setCustomValidity('Required.')", "oninput" => "setCustomValidity('')")) !!}
            </div>
        </div>
        <div class="form-group  col-md-12 ">
            <label class="col-md-4 control-label">Researcher Number </label>
            <div class="col-md-8">
                {!! Form::text('researcher_number', null, array('class'=>'form-control', 'id' => 'researcher_number', 'autocomplete' => 'off')) !!}
            </div>
        </div>
        <div class="form-group  col-md-12 ">
            <label class="col-md-4 control-label">Mykad <font color='red'>*</font></label>
            <div class="col-md-8">
                {!! Form::text('mykad', null, array('class'=>'form-control', 'required'=>'', 'id' => 'mykad', 'autocomplete' => 'off', "oninvalid" => "this.setCustomValidity('Required.')", "oninput" => "setCustomValidity('')")) !!}
            </div>
        </div>
        <div class="form-group  col-md-12 ">
            <label class="col-md-4 control-label">Username <font color='red'>*</font></label>
            <div class="col-md-8">
                {!! Form::text('username', null, array('class'=>'form-control', 'required'=>'', 'id' => 'username', 'autocomplete' => 'off', "oninvalid" => "this.setCustomValidity('Required.')", "oninput" => "setCustomValidity('')")) !!}
            </div>
        </div>
        <div class="form-group  col-md-12 ">
            <label class="col-md-4 control-label">Role</label>
            <div class="col-md-8">
                {!! Form::select('role_id[]',  $role, isset($user) ? $user->role->pluck('role_id') : null, array('class'=>'form-control', 'multiple'=>'multiple')) !!}
            </div>
        </div>
        <div class="form-group col-md-12 ">
    		<label class="col-md-4 control-label"></label>
            <div class="col-md-8">
                <button type="submit" name="save" class="btn btn-primary pull-right btn-sm" value="save">{{isset($user) ? "Update" : "Save"}}</button>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
<script type="text/javascript">
  $(".date").datetimepicker({format: "DD-MM-YYYY"});
</script>

	
