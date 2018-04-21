@extends('layouts.backend')

@section('title',isset($heading) ? $heading : 'Cập nhật')

@section('page-content')
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		{!! Form::model($item, ['method' => 'PATCH', 'url' => route('admin.coupon.update', $item->id), 'class' => 'form-horizontal', 'autocomplete'=>'off']) !!}
		<div class="col-sm-8">
			@include('backend.coupon._form')
		</div>
		<div class="col-sm-4">
			@include('backend.coupon._code')    
			@include('backend.coupon._category')    
		</div>
		{!! Form::close() !!}
	</div>
</div>
@endsection