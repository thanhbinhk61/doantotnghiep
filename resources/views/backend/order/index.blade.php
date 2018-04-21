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
			renderTable('{!! route('admin.order.data') !!}',
			    [
			        { data: 'id', name: 'id', searchable: false },
			        { data: 'code', name: 'code'},
			        { data: 'name', name: 'name'},
			        { data: 'status', orderable: true, name: 'status'},
			        { data: 'total', orderable: false, name: 'total'},
			        { data: 'created_at', name: 'created_at'},
			        { data: 'actions', name: 'actions', orderable: false, searchable: false, sClass: "text-center"}
			    ],{
			    	dom: '<"html5buttons"B>lTfgitp',
                    buttons: [
                        {extend: 'excel', title: 'List-Order', exportOptions:{columns: [1,2,3,4,5]}},
                    ],
		    	createdRow: function ( row, data, index ) {
		    		$('td', row).eq(0).css('display','none');
                   	$('td',row).eq(4).html(toLocaleCurrency(parseCurrency(data.total) + parseCurrency(data.ship)));
		    		var actions = data.actions;
		    		if (!actions || actions.length < 1) { return; }
		    		var $actions = $('td', row).eq(6);
		    		$actions.html('');
		    		if (actions.show) { $actions.append('<a title ="'+actions.show.label+'" class="btn btn-default btn-xs" href="'+actions.show.uri+'"><i class="fa fa-search"></i></a> ');}
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
		    	},initComplete: function () {
		            var table = this.api();                
		            $('.input-search').on('change', function () {
		                var val = $.fn.dataTable.util.escapeRegex($(this).val());
		                table.column(3).search(val ? val : '', true, false).draw();
		            });
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
	                <div class="btn-group">
	                	{!! Form::select('status', $optionStatus , null, ['class' => 'input-search form-control']) !!}
			        </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover prome-datatables" width="100%">
                            <thead>
								<tr>
									<th style="display:none">ID</th>
									<th>Code</th>
									<th>Name</th>
									<th>Status</th>
									<th>Total</th>
									<th>Created_at</th>
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


