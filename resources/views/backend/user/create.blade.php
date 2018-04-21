@extends('layouts.backend')
@section('title',isset($heading) ? $heading : 'Thêm mới')

@section('page-content')

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
    	{!! Form::open(['url' => route('admin.user.store'), 'files' => true, 'class' => 'form-horizontal', 'autocomplete'=>'off']) !!}
			<div class="col-md-8">
			@include('backend.user._form')
    		</div>
    		<div class="col-md-4">
            @include('backend.user._image')
			@include('backend.user._role')
    		</div>
		{!! Form::close() !!}
    </div>
</div>
@endsection

