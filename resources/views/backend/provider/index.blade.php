@extends('layouts.backend')
@section('title',isset($heading) ? $heading : 'Danh sách')
@section('head-append')
    @parent
    {{ HTML::style("assets/backend/css/plugins/dataTables/datatables.min.css") }}
@endsection
@section('body-append')
    @parent
    {{ HTML::script("assets/backend/js/plugins/dataTables/datatables.min.js") }}
    <script>
		var flash_message = '{!!session("flash_message")!!}';
		$(function(){
			renderTable('{!! route('admin.provider.data') !!}',
			    [
			        { data: 'id', name: 'id', searchable: false },
			        { data: 'name', name: 'name'},
			        { data: 'phone', name: 'phone'},
			        { data: 'email', name: 'email'},
			        { data: 'status', name: 'status'},
			        { data: 'actions', name: 'actions', orderable: false, searchable: false, sClass: "text-center"}
			    ],{
		    	createdRow: function ( row, data, index ) {
		    		$('td', row).eq(0).css('display','none');
		    		if (data.actions.edit) {
		    			$('td', row).eq(1).html('<a title="'+data.actions.show.label+'" href="'+data.actions.show.uri+'">'+data.name+'</a>');
		    		}
		    		$('td',row).eq(4).html(data.status==1 ? 'Active' : 'Disable');
		    		var actions = data.actions;
		    		if (!actions || actions.length < 1) { return; }
		    		var $actions = $('td', row).eq(5);
		    		$actions.html('');
		    		if (actions.edit) { $actions.append('<a title ="'+actions.edit.label+'" class="btn btn-default btn-xs" href="'+actions.edit.uri+'"><i class="fa fa-pencil"></i></a> ');}
		    		if (actions.delete) {
			    		var $btn = $('<a title="'+actions.delete.label+'" class="btn btn-danger btn-xs" href="'+actions.delete.uri+'"><i class="fa fa-times"></i></a> ').appendTo($actions);
			    		$btn.on('click',function(event) {
			    			event.preventDefault();
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
			                	swal("Xóa!", "Bạn đã xóa dữ liệu.", "success");
			                    $.post($this.attr('href'), {_method: 'DELETE'}, function (data) {
			                        console.log(data);
			                        window.location.reload();
			                    });
			                });
			    		});
			    	}
		    	}
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
                    @can('provider-write')
                    <div class="ibox-tools">
                        <a href="{{ route('admin.provider.create') }}" class="btn btn-success btn-xs create-link"> <i class="fa fa-plus"></i> {{trans('repositories.create')}}</a>
                    </div>
                    @endcan
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover prome-datatables" width="100%">
                            <thead>
								<tr>
									<th style="display:none">ID</th>
									<th>Name</th>
									<th>Phone</th>
									<th>Email</th>
									<th>Status</th>
									<th>Actions</th>
								</tr>
							</thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


