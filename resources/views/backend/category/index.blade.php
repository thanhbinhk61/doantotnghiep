@extends('layouts.backend')

@section('title',isset($heading) ? $heading : 'Danh sách')

@section('head-append')
    @parent
    {!!HTML::style('assets/backend/js/plugins/summernote/dist/summernote.css')!!}
@endsection

@section('page-content')
<div class="wrapper wrapper-content">
	<div class="row">
        @can('category-write')
		<div class="col-sm-8">
			@if(isset($item))
            {!! Form::model($item, ['method' => 'PATCH','files' => true, 'url' => route('admin.category.update', $item->id), 'role'  => 'form', 'class' => 'form-horizontal', 'autocomplete'=>'off']) !!}
            @include('backend.category._seo')
            @include('backend.category._form',['headingForm' => trans('repositories.edit')])
            {!! Form::close() !!}
            @else
            {!! Form::open(['url' => route('admin.category.store'), 'files' => true, 'class' => 'form-horizontal', 'autocomplete'=>'off']) !!}
            @include('backend.category._seo')
            {!!Form::hidden('type',$type)!!}
            @include('backend.category._form',['headingForm' => trans('repositories.create')])
            {!! Form::close() !!}
            @endif
		</div>
        @endcan
		<div class="col-sm-4">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
                    <h5>{!!$heading or ''!!}</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-down"></i>
                        </a>
                    </div>
                </div>
				<div class="ibox-content">
					<div class="dd" id="nestable">
                        <ol class="dd-list">
                        	@foreach($categories as $category)
                            <li class="dd-item" >
                                <div class="dd-handle">
                                    <span class="pull-right">
                                        @can('category-write')
                                		<a href="{{route('admin.category.edit', $category->id)}}" class="btn btn-default btn-xs"><i class="fa fa-pencil"></i></a>
                                		<a href="{{route('admin.category.destroy', $category->id)}}" class="btn btn-danger btn-xs delete-handle"><i class="fa fa-times"></i></a> 
                                	    @endcan
                                    </span> 
                                    <span title="click toggle" class="label label-info"> <i class="fa {{$category->icon_fa or 'fa-cog'}}"></i></span> <a href="{{route('admin.category.show', $category->id)}}">{{$category->name}}</a>
                                </div>
                                @if(count($category->children) > 0)
                                    <ol class="dd-list">
                                    @foreach($category->children as $children)
                                        <li class="dd-item">
                                            <div class="dd-handle">
                                                <span class="pull-right">
                                                    @can('category-write')
	                                        		<a href="{{route('admin.category.edit', $children->id)}}" class="btn btn-default btn-xs"><i class="fa fa-pencil"></i></a>
	                                        		<a href="{{route('admin.category.destroy', $children->id)}}" class="btn btn-danger btn-xs delete-handle"><i class="fa fa-times"></i></a> 
	                                        	    @endcan
                                                </span> 
                                                <span title="click toggle" class="label label-info"><i class="fa {{$children->icon_fa or 'fa-cog'}}"></i></span> <a href="{{route('admin.category.show', $children->id)}}">{{$children->name}}</a>
                                            </div>
                                            @if(count($children->children) > 0)
                                            <ol class="dd-list">
                                                @foreach($children->children as $children2)
                                                <li class="dd-item">
                                                    <div class="dd-handle">
                                                        <span class="pull-right">
                                                            @can('category-write')
                                                            <a href="{{route('admin.category.edit', $children2->id)}}" class="btn btn-default btn-xs"><i class="fa fa-pencil"></i></a>
                                                            <a href="{{route('admin.category.destroy', $children2->id)}}" class="btn btn-danger btn-xs delete-handle"><i class="fa fa-times"></i></a> 
                                                            @endcan
                                                        </span> 
                                                        <span class="label label-info"><i class="fa fa-cog"></i></span> <a href="{{route('admin.category.show', $children2->id)}}">{{$children2->name}}</a>
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ol>
                                            @endif
                                        </li>
                                    @endforeach
                                    </ol>
                                @endif
                            </li>
                            @endforeach
                        </ol>
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section ('body-append')
	@parent
	{!! HTML::script('assets/backend/js/plugins/nestable/jquery.nestable.js') !!}		<!-- Flash Message -->	
    {!!HTML::script('assets/backend/js/plugins/form-jasnyupload/fileinput.min.js')!!}
	<script>
		var flash_message = '{!!session("flash_message")!!}';
		$(function () {
			$('.delete-handle').click(function (e) {
				e.preventDefault();
				$this = $(this);
                swal({
                    title: "Bạn chắc chắn chứ?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Chắc chắn!",
                    cancelButtonText: "Hủy",
                    closeOnConfirm: false
                }, function() {
                    $.post($this.attr('href'), {_method: 'DELETE'}, function (data) {
                        console.log(data);
                        window.location.reload();
                    });
                });
			});

            $('ol.dd-list li span.label').click(function() {
                $(this).closest('li').children('ol').slideToggle();
                return false;
            });
		});
	</script>
@endsection