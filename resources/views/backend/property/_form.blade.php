<div class="ibox float-e-margins">
	<div class="ibox-title">
        <h5>{!!$heading or 'Thêm mới'!!}</h5>
        <div class="ibox-tools">
            <a class="collapse-link">
                <i class="fa fa-chevron-down"></i>
            </a>
        </div>
    </div>
	<div class="ibox-content">
		@if (count($errors) > 0)
			<div class="alert alert-danger">
				<strong>Whoops!</strong> There were some problems with your input.<br><br>
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
		
		<div class="form-group">
			{!! Form::label('type','Kiểu', ['class'=>'col-sm-2 control-label']) !!}
			<div class="col-sm-8">
				<label class="radio-inline">{!! Form::radio('type','color',true ) !!}  Màu sắc</label>
				<label class="radio-inline">{!! Form::radio('type','brand', (session()->has('type') && session('type') == 'brand') ? true : false) !!}  Thương hiệu</label>
				<label class="radio-inline">{!! Form::radio('type','other', (session()->has('type') && session('type') == 'other') ? true : false ) !!}  Khác</label>
			</div>
		</div>

		<div class="form-group group hide">
            {!! Form::label('category_id', 'Nhóm', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-md-8">
                {!! Form::select('category_id', $categories->lists('name','id') , session()->has('category_id') ? session('category_id') : null, ['class' => 'form-control']) !!}
            </div>
        </div>

		<div class="form-group">
			{!! Form::label('name','Tiêu đề', ['class'=>'col-sm-2 control-label']) !!}
			<div class="col-sm-8">
			{!! Form::text('name',null, ['class' => 'form-control','required','placeholder'=>'Bắt buộc']) !!}
			</div>
		</div>

		<div class="form-group">
			{!! Form::label('value','Giá trị', ['class'=>'col-sm-2 control-label']) !!}
			<div class="col-sm-8">
			{!! Form::text('value',null, ['class' => 'form-control colorpicker-element','required','placeholder'=>'Không dấu']) !!}
			</div>
		</div>

		<div class="form-group brand-logo hide">
			{!! Form::label('logo','Logo', ['class'=>'col-sm-2 control-label']) !!}
			<div class="col-sm-8">
				<div class="fileinput fileinput-new" style="width: 100%;" data-provides="fileinput">
					<div class="fileinput-preview thumbnail mb20" data-trigger="fileinput" style="width: 100px; height: 100px;">
						{!! HTML::image( (isset($item) && $item->logo )? asset($item->logo) :  asset('assets/backend/img/no-image.png'), '') !!}
					</div>
					<div>
						<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Xóa</a>
						<div class="btn btn-default btn-file">
						<span class="fileinput-new">Chọn ảnh</span>
						<span class="fileinput-exists">Thay đôi</span>
						{!! Form::file('logo') !!}
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="form-group">
			{!! Form::label('status','Trạng  thái', ['class'=>'col-sm-2 control-label']) !!}
			<div class="col-sm-8">
				<label class="radio-inline">{!! Form::radio('status',1,true ) !!}  Hiển thị</label>
				<label class="radio-inline">{!! Form::radio('status',2 ) !!}  Ẩn</label>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-8 col-sm-offset-2">
				{!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
		        {!! Form::reset('Cancel', ['class' => 'btn btn-default']) !!}
			</div>
		</div>
	</div>
</div>

@section('body-append')
	@parent
	{!!HTML::script('assets/backend/js/plugins/form-jasnyupload/fileinput.min.js')!!}
	<script>
		$(function(){
			if ($('input:radio[name="type"]:checked').val() == 'color') {
			}
			if ($('input:radio[name="type"]:checked').val() == 'brand') {
				$('.brand-logo').removeClass('hide');
			}
			if ($('input:radio[name="type"]:checked').val() == 'other') {
				$('.group').removeClass('hide');
			}
			$('input:radio[name="type"]').on('change', function () {
				switch($(this).val()) {
				    case 'color':
						$('.brand-logo').addClass('hide');
						$('.group').addClass('hide');
				        break;
				    case 'brand':
						$('.brand-logo').removeClass('hide');
						$('.group').addClass('hide');
				        break;

				    case 'other':
						$('.brand-logo').addClass('hide');
						$('.group').removeClass('hide');
						break;
				}
        	});
        	//$('.colorpicker-element').colorpicker();
		});
	</script>

@endsection