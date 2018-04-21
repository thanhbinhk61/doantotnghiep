@extends('layouts.backend')

@section('title',isset($heading) ? $heading : 'Cập nhật')

@section('page-content')
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		{!! Form::model($item, ['method' => 'PATCH', 'url' => route('admin.slide.update', $item->id), 'files' => true, 'class' => 'form-horizontal', 'autocomplete'=>'off']) !!}
		<div class="col-sm-10">
			@include('backend.slide._form')       
		</div>
		{!! Form::close() !!}
	</div>
</div>
@endsection