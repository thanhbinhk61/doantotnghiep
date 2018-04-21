@extends('layouts.backend')
@section('title',isset($heading) ? $heading : '')

@section('page-content')

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
    	{!! Form::model($item, ['method' => 'PATCH', 'url' => route('admin.user.update', $item->id), 'files' => true, 'class' => 'form-horizontal', 'autocomplete'=>'off']) !!}
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

