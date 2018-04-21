@extends('layouts.backend')

@section('title',isset($heading) ? $heading : 'Thêm mới')

@section('page-content')
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		{!! Form::open(['url' => route('admin.expense.store'),'class' => 'form-horizontal', 'autocomplete'=>'off']) !!}
		<div class="col-sm-8">
			@include('backend.expense._form')       
		</div>
		{!! Form::close() !!}
	</div>
</div>
@endsection