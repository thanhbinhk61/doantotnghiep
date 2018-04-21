@extends('layouts.backend')

@section('title',isset($heading) ? $heading : 'Thêm mới')

@section('page-content')
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		{!! Form::open(['url' => route('admin.provider.store'),'files' => true,'class' => 'form-horizontal', 'autocomplete'=>'off']) !!}
		<div class="col-sm-9">
			@include('backend.provider._form')       
		</div>
		<div class="col-sm-3">
			@include('backend.provider._image')       
		</div>
		{!! Form::close() !!}
	</div>
</div>
@endsection