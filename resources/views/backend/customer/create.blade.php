@extends('layouts.backend')

@section('title',isset($heading) ? $heading : 'Cập nhật')

@section('page-content')
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		{!! Form::open(['url' => route('admin.customer.store'), 'files' => true, 'class' => 'form-horizontal', 'autocomplete'=>'off']) !!}
		<div class="col-sm-7">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
			        <h5>Import danh sách khách hàng</h5>
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
			            {!! Form::label('category_id', 'Nhóm', ['class' => 'col-md-2 control-label']) !!}
			            <div class="col-md-8">
			                {!! Form::select('category_id', $categoryList , null, ['class' => 'form-control']) !!}
			            </div>
			        </div>
        
					<div class="form-group">
						<label class="col-sm-2"><a href="{{asset('files/example-import-customers.xls')}}">Download Example</a></label>
						<div class="col-sm-8">
							{!! Form::file('file') !!}
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