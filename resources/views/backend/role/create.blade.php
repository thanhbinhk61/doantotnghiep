@extends('layouts.backend')

@section('title',isset($heading) ? $heading : 'Thêm mới')

@section('page-content')
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		{!! Form::open(['url' => route('admin.role.store'),'class' => 'form-horizontal', 'autocomplete'=>'off']) !!}
		<div class="col-sm-6">
			@include('backend.role._form')       
		</div>
		<div class="col-sm-6">
			@include('backend.role._ability')       
		</div>
		{!! Form::close() !!}
	</div>
</div>
@endsection