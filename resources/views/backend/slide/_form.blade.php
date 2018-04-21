@section('head-append')
	@parent
	{!!HTML::style('assets/backend/css/plugins/select2/select2.min.css')!!}
@endsection
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
			{!! Form::label('section','Vị trí', ['class'=>'col-sm-2 control-label']) !!}
			<div class="col-sm-8">
				<label class="radio-inline">{!! Form::radio('section',1,true ) !!}  Trang chủ</label>
				<label class="radio-inline">{!! Form::radio('section',2 ) !!}  Trang danh mục</label>
			</div>
		</div>

		<div class="form-group">
			{!! Form::label('name','Tiêu đề', ['class'=>'col-sm-2 control-label']) !!}
			<div class="col-sm-8">
			{!! Form::text('name',null, ['class' => 'form-control','placeholder'=>'tiêu đề']) !!}
			</div>
		</div>

		<div class="form-group">
			{!! Form::label('link','Link', ['class'=>'col-sm-2 control-label']) !!}
			<div class="col-sm-8">
			{!! Form::text('link',null, ['class' => 'form-control','placeholder'=>'Http://']) !!}
			</div>
		</div>

		<div class="form-group category-select2 hide">
            {!! Form::label('category_id', 'Danh mục', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-md-8">
                {!! Form::select('category_id', $categoryList , null, ['class' => 'form-control select2-demo']) !!}
            </div>
        </div>

		<div class="form-group">
			{!! Form::label('image','Image', ['class'=>'col-sm-2 control-label']) !!}
			<div class="col-sm-8">
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
	{!!HTML::script('assets/backend/js/plugins/select2/select2.full.min.js')!!}
	<script>
		$(function () {
			$(".select2-demo").select2();

			if ($('input:radio[name="section"]:checked').val() == '2') {
				$('.category-select2').removeClass('hide');
			}

			$('input:radio[name="section"]').on('change', function () {
				if ($(this).val() == '2') {
					$('.category-select2').removeClass('hide');
				}
				else {
					$('.category-select2').addClass('hide');
				} 
        	});
		});
	</script>	

@endsection