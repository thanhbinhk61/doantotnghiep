@extends('layouts.backend')
@section('title',isset($heading) ? $heading : '')

@section('page-content')

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
    	{!! Form::model($item, ['method' => 'PATCH', 'url' => route('admin.role.update', $item->id),'class' => 'form-horizontal', 'autocomplete'=>'off']) !!}
			<div class="col-md-6">
			@include('backend.role._form')
    		</div>
    		<div class="col-md-6">
            @include('backend.role._ability')
    		</div>
		{!! Form::close() !!}
    </div>
</div>
@endsection

