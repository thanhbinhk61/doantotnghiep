<div class="ibox float-e-margins">
	<div class="ibox-title">
        <h5>{!!$heading or 'Cập nhật'!!}</h5>
        <div class="ibox-tools">
            <a class="collapse-link">
                <i class="fa fa-chevron-down"></i>
            </a>
        </div>
    </div>
	<div class="ibox-content">
		@if (count($errors) > 0)
			<div class="alert alert-danger">
				<strong>Whoops!</strong> There were some problems with your input.<br><br>
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
		
		<div class="form-group">
			{!! Form::label('name','Name', ['class'=>'col-sm-2 control-label']) !!}
			<div class="col-sm-8">
			{!! Form::text('name',null, ['class' => 'form-control','disabled']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('email','Email', ['class'=>'col-sm-2 control-label']) !!}
			<div class="col-sm-8">
			{!! Form::email('email',null, ['class' => 'form-control','disabled']) !!}
			</div>
		</div>

		@if (isset($item) && $item->provider_id != 0)
		<div class="form-group">
            {!! Form::label('password','Password', ['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-8">
            {!! Form::password('password', ['class' => 'form-control','placeholder'=>'Bắt buộc']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('password_confirmation','Confirm Password:', ['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-8">
            {!! Form::password('password_confirmation', ['class' => 'form-control','placeholder'=>'Bắt buộc']) !!}
            </div>
        </div>
        @endif

		@if (isset($item) && $item->provider_id == 0)
		<div class="form-group">
            {!! Form::label('category_id', 'Nhóm', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-md-8">
                {!! Form::select('category_id', $categoryList , null, ['class' => 'form-control']) !!}
            </div>
        </div>
        @endif
		
		<div class="form-group">
			{!! Form::label('status','Trạng  thái', ['class'=>'col-sm-2 control-label']) !!}
			<div class="col-sm-8">
				<label class="radio-inline">{!! Form::radio('status',1,true ) !!}  Enable</label>
				<label class="radio-inline">{!! Form::radio('status',2 ) !!}  Disable</label>
			</div>
		</div>


		<div class="form-group">
			<div class="col-sm-8 col-sm-offset-2">
				{!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
		        {!! Form::reset('Cancel', ['class' => 'btn btn-default']) !!}
			</div>
		</div>
	</div>
</div>