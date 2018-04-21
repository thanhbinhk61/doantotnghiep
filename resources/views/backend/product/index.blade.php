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
			renderTable('{!! isset($category->id) ? route('admin.product.data.category', $category->id) : route('admin.product.data') !!}',
			    [
			        { data: 'id', name: 'id', searchable: false },
			        { data: 'image', name: 'image',orderable: false, sClass: "text-center"},
			        { data: 'name', name: 'name'},
			        { data: 'quantity', name: 'quantity'},
			        { data: 'status', orderable: true, name: 'status', sClass: "text-center"},
			        { data: 'actions', name: 'actions', orderable: false, searchable: false, sClass: "text-center"},
			        { data: 'code', name: 'code'},
			        { data: 'provider_id', name: 'provider_id'}
			    ],{
		    	createdRow: function ( row, data, index ) {
		    		var status;
		    		switch (data.status) {
		    			case '1' : status = 'Hiển trang chủ'; break;
		    			case '2' : status = 'Ẩn trang chủ'; break;
		    			case '3' : status = 'Ẩn hết'; break;
		    		}
		    		$('td', row).eq(0).css('display','none');		    		
		    		$('td', row).eq(6).css('display','none');		    		
		    		$('td', row).eq(7).css('display','none');		    		
		    		$('td',row).eq(1).html('<img class="img-thumbnail" src="'+laroute.route('image.resize', {file:data.image,w:36,h:36})+'"/>');
		    		if (data.actions.edit) {
		    			$('td', row).eq(2).html('<a title="'+data.actions.edit.label+'" href="'+laroute.route('admin.product.edit',{product:data.id})+'">'+data.name+'</a>');
		    		}
		    		$('td',row).eq(4).html(status);
		    		var actions = data.actions;
		    		if (!actions || actions.length < 1) { return; }
		    		var $actions = $('td', row).eq(5);
		    		$actions.html('<div class="btn-group"></div>');
		    		if (actions.edit) { $actions.append('<a  target="_blank" title ="'+actions.show.label+'" class="btn btn-primary radius-none" href="'+laroute.route('product.show',{slug:data.slug})+'">'+actions.show.label+'</a>');}
		    		if (actions.delete) {
			    		var $btn = $('<a title="'+actions.delete.label+'" class="btn btn-primary radius-none" href="'+actions.delete.uri+'">'+actions.delete.label+'</a>').appendTo($actions);
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
		                table.column(7).search(val ? val : '', true, false).draw();
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
						<span class="btn btn-default">{!!$category->name or 'Tất cả' !!}</span>
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" >
							<i class="caret"></i>
						</button>
						<ul class="dropdown-menu pull-left">
						  	<li><a href="{!!route('admin.product.index')!!}">Tất cả</a></li>
						    @foreach ($categories as $id => $name)
							<li><a href="{{route('admin.product.category', $id)}}">{{$name}}</a></li>
							@endforeach
						</ul>
					</div>
					<div class="btn-group">
	                	{!! Form::select('provider_id', $providerList , null, ['class' => 'input-search form-control']) !!}
			        </div>
					@can ('product-write')
                    <div class="ibox-tools">
                        <a href="{{ route('admin.product.create') }}" class="btn btn-success btn-xs create-link"> <i class="fa fa-plus"></i> {{trans('repositories.create')}}</a>
                    </div>
                    @endcan
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover prome-datatables" width="100%">
                            <thead>
								<tr>
									<th style="display:none">ID</th>
									<th width="40px">Ảnh</th>
									<th>Tên</th>
									<th>Số lượng</th>
									<th>Hiện trang chủ</th>
									<th>Thao tác</th>
									<th style="display:none">Code</th>
									<th style="display:none">Provider</th>
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