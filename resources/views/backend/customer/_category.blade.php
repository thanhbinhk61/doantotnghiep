<div class="ibox float-e-margins">
	<div class="ibox-title">
        <h5>Nhóm Khách hàng</h5>
        <div class="ibox-tools">
            <a class="collapse-link">
                <i class="fa fa-chevron-down"></i>
            </a>
        </div>
    </div>
	<div class="ibox-content">

        {!! Form::open(['url' => route('admin.category.store'),'class' => 'form-horizontal', 'autocomplete'=>'off']) !!}
        {!!Form::hidden('type','customer')!!}
        <div class="form-group">
            {!! Form::label('name','Thêm tiêu đề', ['class'=>'col-sm-12 control-label']) !!}
            <div class="col-sm-12">
            {!! Form::text('name',null, ['class' => 'form-control','required','placeholder'=>'Bắt buộc']) !!}
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-6">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>
        </div>
        {!! Form::close() !!}
        <hr>
        <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    {!! Form::open(['url' => '','autocomplete'=>'off']) !!}
                    <input name="_method" type="hidden" value="PATCH">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Cập nhật</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            {!! Form::label('name','Tên', ['class'=>'control-label']) !!}
                            {!! Form::text('name',null, ['class' => 'form-control','required','placeholder'=>'Name']) !!}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        {!! Form::submit('Cập nhật', ['class' => 'btn btn-primary']) !!}
                    </div>
                    {!! Form::close() !!}
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

		<div class="dd" id="nestable">
            <ol class="dd-list">
            	@foreach($categories as $category)
                <li class="dd-item" >
                    <div class="dd-handle">
                    	<span class="pull-right">
                    		<a href="#modalEdit" data-value="{{json_encode(['id'=>$category->id, 'name'=>$category->name])}}" data-toggle="modal" class="btn btn-default btn-xs"><i class="fa fa-pencil"></i></a>
                    		<a href="{{route('admin.category.destroy', $category->id)}}" class="btn btn-danger btn-xs delete-handle"><i class="fa fa-times"></i></a> 
                    	</span> 
                        <span title="click toggle" class="label label-info"> <i class="fa fa-cog"></i></span> <span>{{$category->name}}</span>
                    </div>
                </li>
                @endforeach
            </ol>
        </div>
	</div>
</div>
@section ('body-append')
    @parent
    <script>
        var flash_message = '{!!session("flash_message")!!}';
        $(function () {
            $('#modalEdit').on('show.bs.modal', function (event) {
                var value = $(event.relatedTarget).data('value')
                var id = value.id;
                var name = value.name;
                $(this).find('form').attr('action',laroute.route('admin.category.update',{category:id}));
                $(this).find('input[name="name"]').val(name);
            });

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