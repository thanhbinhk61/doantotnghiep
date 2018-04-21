@extends('layouts.backend')

@section('title',isset($heading) ? $heading : 'Cập nhật')

@section('page-content')
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		{!! Form::model($item, ['method' => 'PATCH', 'url' => route('admin.post.update', $item->id), 'files' => true, 'class' => 'form-horizontal', 'autocomplete'=>'off']) !!}
		<div class="col-sm-8">
			@include('backend.post._form')       
		</div>
		<div class="col-sm-4">
			@include('backend.post._seo') 
			@include('backend.post._image') 
			@include('backend.post._category') 
		</div>
		{!! Form::close() !!}
	</div>
</div>
@endsection