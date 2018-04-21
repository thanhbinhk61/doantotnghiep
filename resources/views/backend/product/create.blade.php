@extends('layouts.backend')

@section('title',isset($heading) ? $heading : 'Thêm mới')

@section('page-content')
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		{!! Form::open(['url' => route('admin.product.store'), 'files' => true, 'class' => 'form-horizontal', 'autocomplete'=>'off','id' => 'main-form']) !!}
		<div class="col-sm-8">
			@include('backend.product._form')
			@include('backend.product._album')        
		</div>
		<div class="col-sm-4">
			@include('backend.product._seo') 
			@include('backend.product._video') 
			@include('backend.product._image') 
			@include('backend.product._category') 
			@include('backend.product._property') 
		</div>
		{!! Form::close() !!}
	</div>
</div>
@endsection