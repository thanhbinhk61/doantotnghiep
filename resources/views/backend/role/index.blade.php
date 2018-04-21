@extends('layouts.backend')
@section('title',isset($heading) ? $heading : 'Danh sách')
@section('body-append')
    @parent
    <script>
		var flash_message = '{!!session("flash_message")!!}';
		$(function(){
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
		});
	</script>
@endsection

@section('page-content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5></h5>
                    @can('role-write')
                    <div class="ibox-tools">
                        <a href="{{ route('admin.role.create') }}" class="btn btn-success btn-xs create-link"> <i class="fa fa-plus"></i> {{trans('repositories.create')}}</a>
                    </div>
                    @endcan
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover prome-datatables" width="100%">
                            <thead>
								<tr>
									<th>Tên nhóm</th>
									<th>Quyền</th>
									<th>Thao tác</th>
								</tr>
							</thead>
                            <tbody>
                            	@foreach($roles as $role)
                            	<tr>
		                            <td>{{ $role->name }}</td>
		                            <td>
		                            {!!
		                            	$role->abilities->lists('name')->map(function ($item) {
		                            		$parts = explode('-', $item);
		                            		return '<span class="label label-default">' . $parts[1] . '-' . trans('repositories.'. $parts[0]) . '</span>';
		                            	})->implode(' ')

		                            !!}
		                            </td>
		                            <td>
                                        @can('role-write')
		                                <a href="{{ route('admin.role.edit', $role) }}" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
		                                <a href="{{route('admin.role.destroy', $role)}}" class="btn btn-xs btn-danger delete-handle"><i class="fa fa-times"></i></a>
		                                @endcan
                                    </td>
		                        </tr>
                            	@endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


