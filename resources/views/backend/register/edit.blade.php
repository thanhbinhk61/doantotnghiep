@extends('layouts.backend')

@section('title',isset($heading) ? $heading : 'Cập nhật')

@section('page-content')
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-sm-8">
			@include('backend.register._info')
		</div>
		{!! Form::model($item, ['method' => 'PATCH', 'url' => route('admin.register.update', $item->id), 'class' => 'form-horizontal', 'autocomplete'=>'off']) !!}
		<div class="col-sm-4">
			@include('backend.register._form')  
		</div>
		{!! Form::close() !!}
	</div>
</div>
@endsection