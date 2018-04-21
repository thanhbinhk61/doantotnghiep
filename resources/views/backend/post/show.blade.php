@extends('layouts.backend')

@section('title',isset($heading) ? $heading : '')

@section('page-content')
<div class="page-content">
	<ol class="breadcrumb">                      
		<li><a href="/">{{ucfirst(trans('repositories.dashboard'))}}</a></li>
		<li><a href="{!!route('admin.post.index')!!}">{{trans('repositories.post')}}</a></li>
		<li class="active">{{trans('repositories.show')}}</li>
    </ol>
	<div class="container-fluid">
		<div data-widget-group="group1">
			<div class="col-sm-9">
				<div class="panel panel-bluegray" data-widget='{"draggable": "false"}'>
					<div class="panel-heading">
						<h2>
				    		<ul class="nav nav-tabs">
								<li class="active"><a href="#tab-about" role="tab" data-toggle="tab">Thông tin</a></li>
								<li><a href="#tab-content" role="tab" data-toggle="tab">Nội dung</a></li>
								<li><a href="#tab-comment" role="tab" data-toggle="tab">Comment</a></li>
							</ul>
				    	</h2>
						<div class="panel-ctrls" data-actions-container="" data-action-collapse='{"target": ".panel-body"}'>
							<a href="{!!route('admin.post.edit',$item->id)!!}" style="float:left"class="button-icon"><i class="ti ti-pencil"></i></a>
						</div>
					</div>
					<div class="panel-body">
						<div class="tab-content">
							<div class="tab-pane active" id="tab-about">
								<div class="about-area">
							      	<h4>Giới thiệu</h4>
							      	<p>{!!$item->intro!!}</p>
								</div>
								<div class="about-area">
									<h4>Thông tin </h4>
									<div class="table-responsive">
										<table class="table">
											<tbody>
												<tr>
													<th>Name</th>
													<td>{{$item->name}}</td>
												</tr>
												<tr>
													<th>Slug</th>
													<td>{{$item->slug}}</td>
												</tr>
												<tr>
													<th>Tags</th>
													<td>{{$item->tags}}</td>
												</tr>
												<tr>
													<th>Title</th>
													<td>{{$item->title}}</td>
												</tr>
												<tr>
													<th>Keyword</th>
													<td>{{$item->keyword}}</td>
												</tr>
												<tr>
													<th>Description</th>
													<td>{{$item->description}}</td>
												</tr>
												<tr>
													<th>Nhóm</th>
													<td>
														@foreach ($item->categories as $cate)
															<span class="label label-info">{{$cate->name}}</span>
														@endforeach
													</td>
												</tr>
												<tr>
													<th>User</th>
													<td>{{$item->user->name}}</td>
												</tr>
												<tr>
													<th>Ngày tạo</th>
													<td>{{$item->created_at}}</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<div class="tab-pane" id="tab-content">
								<div class="about-area">
							      	<h4>Tóm tắt</h4>
							      	<p>{!!$item->content!!}.</p>
								</div>
							</div>
							<div class="tab-pane" id="tab-comment">
								@include('backend.post._comment')
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="panel panel-bluegray" data-widget='{"draggable": "false"}'>
					<div class="panel-heading">
						<h2>Image</h2>
						<div class="panel-ctrls" data-actions-container="" data-action-collapse='{"target": ".panel-body"}'></div>
					</div>
					<div class="panel-body">
						<img src="{!!($item->image )? asset($item->image) :  asset('assets/backend/img/no-image.png')!!}" alt="" class="img-responsive user-avatar">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
@section ('body-append')
	@parent
	<script type="text/javascript">
		$(function () {
			$('#reply-moda').on('show.bs.modal', function (event) {
			  	var parent = $(event.relatedTarget).data('parent');
			  	$(this).find('input[name="parent_id"]').val(parent);
			})
		});
	</script>
@endsection