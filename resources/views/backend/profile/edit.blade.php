@extends('layouts.backend')
@section('title',isset($heading) ? $heading : '')

@section('page-content')

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
    	{!! Form::model($item, ['url' => route('admin.profile.update'), 'files' => true, 'class' => 'form-horizontal', 'autocomplete'=>'off']) !!}
			<div class="col-md-8">
			@include('backend.profile._form')
    		</div>
    		<div class="col-md-4">
			@include('backend.profile._image')
    		</div>
		{!! Form::close() !!}
    </div>
</div>
@endsection

