@extends('layouts.backend')

@section('title',isset($heading) ? $heading : 'Cập nhật')

@section('page-content')
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		{!! Form::model($item, ['method' => 'PATCH', 'url' => route('admin.page.update', $item->id), 'files' => true, 'class' => 'form-horizontal', 'autocomplete'=>'off']) !!}
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