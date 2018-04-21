<div class="ibox float-e-margins">
	<div class="ibox-title">
        <h5>Bình luận ({{$item->getRating->first()->rating}} <i class="fa fa-star"></i> )</h5>
        <div class="ibox-tools">
            <a class="collapse-link">
                <i class="fa fa-chevron-down"></i>
            </a>
        </div>
    </div>
	<div class="ibox-content">
		<div class="table-responsive">
			<table width="100%" class="table table-striped table-bordered table-hover prome-datatables">
				<thead>
					<tr>
						<th>Tên</th>
						<th>Email</th>
						<th>Phone</th>
						<th>Vote</th>
						<th>Nội dung</th>
						<th>Status</th>
						<th>Thao tác</th>
					</tr>
				</thead>
				<tbody>
				@foreach ($item->comments as $comment)
					<tr>
						<td>{{$comment->name}}</td>
						<td>{{$comment->email}}</td>
						<td>{{$comment->phone}}</td>
						<td>{{$comment->vote}}</td>
						<td>{{$comment->content}}</td>
						<td><a href="{{route('admin.comment.edit',$comment->id)}}" title="click để thay đổi" data-status="{{$comment->status}}" class="status-change label label-primary">{{config('umzila.status.' . $comment->status)}}</a></td>
						<td class=" text-center">
							<a title="xóa" data class="btn btn-danger btn-xs delete-comment" href="{{route('admin.comment.destroy',$comment->id)}}"><i class="fa fa-times"></i></a>
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

@section('body-append')
@parent
<script>
$(function(){
	$('.delete-comment').on('click',function(event) {
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

	$('a.status-change').on('click',function(event) {
		event.preventDefault();
		$this = $(this);
		var status = $this.attr('data-status');
		$.post($(this).attr('href'), {_method: 'POST',status:status}, function (data) {
	            $this.text(data.text);
	            $this.attr('data-status',data.value);
	        });

	});
});
</script>
@endsection