@extends('layouts.backend')

@section('title',isset($heading) ? $heading : '')

@section('page-content')
<div class="page-content">
	<ol class="breadcrumb">                      
		<li><a href="/">{{ucfirst(trans('repositories.dashboard'))}}</a></li>
		<li><a href="{!!route('admin.page.index')!!}">{{trans('repositories.page')}}</a></li>
		<li class="active">{{trans('repositories.show')}}</li>
    </ol>
	<div class="container-fluid">
		<div data-widget-group="group1">
			<div class="col-sm-12">
				<div class="panel panel-bluegray" data-widget='{"draggable": "false"}'>
					<div class="panel-heading">
						<h2>{!!$heading or 'Info'!!}</h2>
						<div class="panel-ctrls" data-actions-container="" data-action-collapse='{"target": ".panel-body"}'>
							<a href="{!!route('admin.page.edit',$item->id)!!}" style="float:left"class="button-icon"><i class="ti ti-pencil"></i></a>
						</div>
					</div>
					<div class="panel-body">
						<div class="about-area">
					      	<h4>Giới thiệu</h4>
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
											<th>User</th>
											<td>{{$item->user->name}}</td>
										</tr>
										<tr>
											<th>Ngày tạo</th>
											<td>{{$item->created_at}}</td>
										</tr>
										<tr>
											<th>Nội dung </th>
											<td>{!!$item->content!!}</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
