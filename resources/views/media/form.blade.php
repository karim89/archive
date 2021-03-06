<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h2 class="modal-title" id="myModalLabel">Form Media</h2>
</div>
<div class="modal-body">
    @if(isset($media))
        {!! Form::model($media, array('url'=> URL::to('media/update/'.$media->id), 'class'=>'form-horizontal', 'enctype' => 'multipart/form-data')) !!}
    @else
        {!! Form::open(array('url' => 'media/store', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data')) !!}
    @endif
    <div class="row">
        <div class="form-group  col-md-12 ">
            <label class="col-md-4 control-label">Code <font color='red'>*</font></label>
            <div class="col-md-8">
                {!! Form::text('code', null, array('class'=>'form-control', 'required'=>'', 'id' => 'code', 'autocomplete' => 'off', "oninvalid" => "this.setCustomValidity('Required.')", "oninput" => "setCustomValidity('')")) !!}
            </div>
        </div>
        <div class="form-group  col-md-12 ">
            <label class="col-md-4 control-label">Title Bm <font color='red'>*</font></label>
            <div class="col-md-8">
                {!! Form::text('title_bm', null, array('class'=>'form-control', 'required'=>'', 'id' => 'title_bm', 'autocomplete' => 'off', "oninvalid" => "this.setCustomValidity('Required.')", "oninput" => "setCustomValidity('')")) !!}
            </div>
        </div>
        <div class="form-group  col-md-12 ">
            <label class="col-md-4 control-label">Title Eng <font color='red'>*</font></label>
            <div class="col-md-8">
                {!! Form::text('title_eng', null, array('class'=>'form-control', 'required'=>'', 'id' => 'title_eng', 'autocomplete' => 'off', "oninvalid" => "this.setCustomValidity('Required.')", "oninput" => "setCustomValidity('')")) !!}
            </div>
        </div>
        <div class="form-group  col-md-12 ">
            <label class="col-md-4 control-label">Description Bm</label>
            <div class="col-md-8">
                {!! Form::textarea('description_bm', null, array('class'=>'form-control')) !!}
            </div>
        </div>
        <div class="form-group  col-md-12 ">
            <label class="col-md-4 control-label">Description Eng</label>
            <div class="col-md-8">
                {!! Form::textarea('description_eng', null, array('class'=>'form-control')) !!}
            </div>
        </div>
        <div class="form-group col-md-12 ">
            <label class="col-md-4 control-label"></label>
            <div class="col-md-8">
                <button type="submit" name="save" class="btn btn-primary pull-right btn-sm" value="save">{{isset($media) ? "Update" : "Save"}}</button>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}

    
