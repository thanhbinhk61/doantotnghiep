@extends('layouts.backend')

@section('title',isset($heading) ? $heading : 'Thêm mới')

@section('page-content')
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		{!! Form::open(['url' => route('admin.page.store'),'class' => 'form-horizontal', 'autocomplete'=>'off']) !!}
		<div class="col-sm-8">
			@include('backend.page._form')       
		</div>
		<div class="col-sm-4">
			@include('backend.page._seo') 
		</div>
		{!! Form::close() !!}
	</div>
</div>
@endsection