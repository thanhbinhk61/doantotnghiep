@extends('layouts.backend')

@section('title',isset($heading) ? $heading : 'Cập nhật')

@section('head-append')
	@parent
    {!!HTML::style('assets/backend/css/plugins/select2/select2.min.css')!!}
@endsection

@section('page-content')
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		{!! Form::open(['url' => route('admin.customer.provider.store'), 'class' => 'form-horizontal', 'autocomplete'=>'off']) !!}
		<div class="col-sm-7">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
			        <h5>Create</h5>
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
			            {!! Form::label('provider_id', 'Nhà cung cấp', ['class' => 'col-md-2 control-label']) !!}
			            <div class="col-md-8">
			                {!! Form::select('provider_id', $providerList , null, ['class' => 'form-control select2-demo']) !!}
			            </div>
			        </div>

			        <div class="form-group">
						{!! Form::label('name','Name', ['class'=>'col-sm-2 control-label']) !!}
						<div class="col-sm-8">
						{!! Form::text('name',null, ['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="form-group">
						{!! Form::label('email','Email', ['class'=>'col-sm-2 control-label']) !!}
						<div class="col-sm-8">
						{!! Form::email('email',null, ['class' => 'form-control']) !!}
						</div>
					</div>

					<div class="form-group">
						{!! Form::label('phone','Phone', ['class'=>'col-sm-2 control-label']) !!}
						<div class="col-sm-8">
						{!! Form::text('phone',null, ['class' => 'form-control']) !!}
						</div>
					</div>

					<div class="form-group">
						{!! Form::label('address','Địa chỉ', ['class'=>'col-sm-2 control-label']) !!}
						<div class="col-sm-8">
						{!! Form::text('address',null, ['class' => 'form-control']) !!}
						</div>
					</div>


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
		</div>
		{!! Form::close() !!}
	</div>
</div>
@endsection

@section('body-append')
	@parent
    {!!HTML::script('assets/backend/js/plugins/select2/select2.full.min.js')!!}

	<script>
		$(function(){
			$(".select2-demo").select2();
		});
	</script>
@endsection