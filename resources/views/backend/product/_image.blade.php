<div class="ibox float-e-margins">
	<div class="ibox-title">
        <h5>Image</h5>
        <div class="ibox-tools">
            <a class="collapse-link">
                <i class="fa fa-chevron-down"></i>
            </a>
        </div>
    </div>
	<div class="ibox-content">
		<div class="form-group">
			<div class="col-md-12">
				{!! Form::label('image','Ảnh sản phẩm') !!}
				<div class="fileinput fileinput-new" style="width: 100%;" data-provides="fileinput">
					<div class="fileinput-preview thumbnail mb20" data-trigger="fileinput" style="width: 100%; height: 150px;">
						{!! HTML::image( (isset($item) && $item->image )? asset($item->image) :  asset('assets/backend/img/no-image.png'), '') !!}
					</div>
					<div>
						<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Xóa</a>
						<div class="btn btn-default btn-file">
						<span class="fileinput-new">Chọn ảnh</span>
						<span class="fileinput-exists">Thay đôi</span>
						{!! Form::file('image') !!}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@section('body-append')
	@parent
	{!!HTML::script('assets/backend/js/plugins/form-jasnyupload/fileinput.min.js')!!}
@endsection