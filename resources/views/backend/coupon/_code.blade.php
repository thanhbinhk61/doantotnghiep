<div class="ibox float-e-margins">
	<div class="ibox-title">
        <h5>Danh sách mã Code ({{count($codes)}}) item</h5>
        <div class="ibox-tools">
            <a class="collapse-link">
                <i class="fa fa-chevron-down"></i>
            </a>
        </div>
    </div>
	<div class="ibox-content">
		<div class="dd" id="nestable">
            <ol class="dd-list">
            	@foreach($codes as $code)
                <li class="dd-item" >
                    <div class="dd-handle">
                    	<span class="pull-right">
                    		<a href="{{route('admin.coupon.code.destroy', $code->id)}}" class="btn btn-danger btn-xs delete-handle"><i class="fa fa-times"></i></a> 
                    	</span> 
                         <span>{{$code->code}}</span>
                    </div>
                </li>
                @endforeach
            </ol>
        </div>
        <nav>
            {!!$codes->render()!!}
        </nav>
	</div>
</div>
@section ('body-append')
    @parent
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
                        window.location.reload();
                    });
                });
            });
        });
    </script>
@endsection