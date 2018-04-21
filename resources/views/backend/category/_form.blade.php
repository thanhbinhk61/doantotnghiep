@section('head-append')
	@parent
	{!!HTML::style('assets/backend/css/plugins/colorpicker/bootstrap-colorpicker.min.css')!!}
	{!!HTML::style('assets/backend/css/plugins/switchery/switchery.css')!!}

@endsection
<div class="ibox float-e-margins">
	<div class="ibox-title">
        <h5>{{isset($item) ? ucfirst(trans('repositories.edit')) : ucfirst(trans('repositories.create')) }} {{$heading or ''}}</h5>
        <div class="ibox-tools">
        	@if (isset($item))
	            <a href="{{ route('admin.category.type',$type) }}" class="btn btn-success btn-xs create-link"> <i class="fa fa-plus"></i> {{trans('repositories.create')}}</a>
	        @endif
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
			{!! Form::label('name','Tiêu đề', ['class'=>'col-sm-2 control-label']) !!}
			<div class="col-sm-8">
			{!! Form::text('name',null, ['class' => 'form-control','required','placeholder'=>'Bắt buộc']) !!}
			</div>
		</div>

		<div class="form-group">
			{!! Form::label('parent_id','Danh mục cha', ['class'=>'col-sm-2 control-label']) !!}
			<div class="col-sm-8">
			{!! Form::select('parent_id',$listCategories, session()->has('flash_parent') ? session('flash_parent') : null,['class' => 'form-control']) !!}
			</div>
		</div>
		<div class="hr-line-dashed"></div>
		<div class="form-group">
			{!! Form::label('intro','Mô tả', ['class'=>'col-sm-2 control-label']) !!}
			<div class="col-sm-8">
			{!! Form::textarea('intro',null, ['class' => 'form-control','rows'=>'4']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('order','Thứ tự', ['class'=>'col-sm-2 control-label']) !!}
			<div class="col-sm-8">
			{!! Form::text('order',null, ['class' => 'form-control','placeholder'=>'0']) !!}
			</div>
		</div>
		@if ((isset($type) && $type=='post') || (isset($item) && $item->type=='post'))
		<div class="form-group">
			{!! Form::label('feature','Hiện trang chủ', ['class'=>'col-sm-2 control-label']) !!}
			<div class="col-sm-8">
				<div class="switch">
		            <div class="onoffswitch">
		                <input name="feature" type="checkbox" @if (isset($item) && $item->feature ==2) checked @endif class="onoffswitch-checkbox" value="2" id="example1">
		                <label class="onoffswitch-label" for="example1">
		                    <span class="onoffswitch-inner"></span>
		                    <span class="onoffswitch-switch"></span>
		                </label>
		            </div>
		        </div>
			</div>
		</div>
		@endif
		@if ((isset($type) && $type=='product') || (isset($item) && $item->type=='product'))
		<div class="form-group">
			{!! Form::label('image','Image', ['class'=>'col-sm-2 control-label']) !!}
			<div class="col-sm-8">
				<div class="fileinput fileinput-new" style="width: 100%;" data-provides="fileinput">
					<div class="fileinput-preview thumbnail mb20" data-trigger="fileinput" style="width: 150px; height: 100px;">
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
			{!! Form::label('icon_fa','Icon', ['class'=>'col-sm-2 control-label']) !!}
			<div class="col-sm-8">
			{!! Form::text('icon_fa',null, ['class' => 'form-control','placeholder'=>'Ví dụ: fa-cog']) !!}
			</div>
		</div>

		<div class="form-group">
			{!! Form::label('color','Màu sắc', ['class'=>'col-sm-2 control-label']) !!}
			<div class="col-sm-8">
			{!! Form::text('color',null, ['class' => 'form-control colorpicker-element']) !!}
			</div>
		</div>
		@endif

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
	{!!HTML::script('assets/backend/js/plugins/colorpicker/bootstrap-colorpicker.min.js')!!}
	{!!HTML::script('assets/backend/js/plugins/switchery/switchery.js')!!}
	<script>
		$(function(){
        	$('.colorpicker-element').colorpicker();        
		});
	</script>

@endsection
