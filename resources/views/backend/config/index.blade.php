@extends('layouts.backend')

@section('title',isset($heading) ? $heading : 'Danh sách')

@section('head-append')
	@parent
	{!!HTML::style('assets/backend/js/plugins/summernote/dist/summernote.css')!!}
@endsection

@section('page-content')
<div class="wrapper wrapper-content">
	<div class="row">
		{!! Form::model($item,['method' => 'PATCH', 'url' => route('admin.config.update', $item->id), 'files' => true, 'class' => 'form-horizontal']) !!}
		<div class="col-sm-8">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
			        <h5>{!!$heading or 'Config'!!}</h5>
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
						{!! Form::label('facebook','Facebook', ['class'=>'col-sm-2 control-label']) !!}
						<div class="col-sm-8">
						{!! Form::text('facebook',null, ['class' => 'form-control']) !!}
						</div>
					</div> 

					<div class="form-group">
						{!! Form::label('twitter','Twitter', ['class'=>'col-sm-2 control-label']) !!}
						<div class="col-sm-8">
						{!! Form::text('twitter',null, ['class' => 'form-control']) !!}
						</div>
					</div> 

					<div class="form-group">
						{!! Form::label('youtube','Youtube', ['class'=>'col-sm-2 control-label']) !!}
						<div class="col-sm-8">
						{!! Form::text('youtube',null, ['class' => 'form-control']) !!}
						</div>
					</div> 

					<div class="form-group">
						{!! Form::label('email','Email', ['class'=>'col-sm-2 control-label']) !!}
						<div class="col-sm-8">
						{!! Form::email('email',null, ['class' => 'form-control']) !!}
						</div>
					</div> 

					<div class="form-group">
						{!! Form::label('phone','Phone', ['class'=>'col-sm-2 control-label']) !!}
						<div class="col-sm-8">
						{!! Form::text('phone',null, ['class' => 'form-control']) !!}
						</div>
					</div>

					<div class="form-group">
						{!! Form::label('address','Address', ['class'=>'col-sm-2 control-label']) !!}
						<div class="col-sm-8">
						{!! Form::text('address',null, ['class' => 'form-control']) !!}
						</div>
					</div>  

					<div class="form-group">
						{!! Form::label('timework','Thời gian làm việc', ['class'=>'col-sm-2 control-label']) !!}
						<div class="col-sm-8">
						{!! Form::text('timework',null, ['class' => 'form-control']) !!}
						</div>
					</div>  

					<div class="form-group">
						{!! Form::label('intro','Giới thiệu', ['class'=>'col-sm-2 control-label']) !!}
						<div class="col-sm-8">
						{!! Form::textarea('intro',null, ['class' => 'form-control textarea-summernote','rows'=>'3']) !!}
						</div>
					</div>

					<div class="form-group">
						{!! Form::label('card_atm','Thông tin thanh toán', ['class'=>'col-sm-2 control-label']) !!}
						<div class="col-sm-8">
						{!! Form::textarea('card_atm',null, ['class' => 'form-control textarea-summernote','rows'=>'3']) !!}
						</div>
					</div>

					<div class="form-group">
						{!! Form::label('scripts','Mã nhúng', ['class'=>'col-sm-2 control-label']) !!}
						<div class="col-sm-8">
						{!! Form::textarea('scripts',null, ['class' => 'form-control','rows'=>'6']) !!}
						</div>
					</div>

					<div class="form-group">
						{!! Form::label('icon','Icon', ['class'=>'col-sm-2 control-label']) !!}
						<div class="col-sm-8">
							<div class="fileinput fileinput-new" style="width: 100%;" data-provides="fileinput">
								<div class="fileinput-preview thumbnail mb20" data-trigger="fileinput" style="width: 100px; height: 100px;">
									{!! HTML::image( (isset($item) && $item->icon )? asset($item->icon) :  asset('assets/backend/img/no-image.png'), '') !!}
								</div>
								<div>
									<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Xóa</a>
									<div class="btn btn-default btn-file">
									<span class="fileinput-new">Chọn ảnh</span>
									<span class="fileinput-exists">Thay đôi</span>
									{!! Form::file('icon') !!}
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-8 col-sm-offset-2">
							{!! Form::submit('Save & Clear cache', ['class' => 'btn btn-primary','title' => 'Lưu và xóa cache']) !!}
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<div class="ibox-tools">
			            <a class="collapse-link">
			                <i class="fa fa-chevron-down"></i>
			            </a>
			        </div>
					<ul class="nav nav-tabs">
						<li class="active"><a href="#tab-title" data-toggle="tab">TIT</a></li>
						<li><a href="#tab-keywords" data-toggle="tab">KEY</a></li>
						<li><a href="#tab-description" data-toggle="tab">DES</a></li>
					</ul>
				</div>
				<div class="ibox-content">
					<div class="tab-content">
						<div class="tab-pane active" id="tab-title">
							<div class="form-group">
								{!! Form::label('title','Title', ['class'=>'col-sm-12 control-label']) !!}
								<div class="col-sm-12">
								{!! Form::text('title',null, ['class' => 'form-control', 'placeholder'=>'SEO - Title']) !!}
								</div>
							</div>
						</div>

						<div class="tab-pane" id="tab-keywords">
							<div class="form-group">
								{!! Form::label('keywords','Keywords', ['class'=>'col-sm-12 control-label']) !!}
								<div class="col-sm-12">
								{!! Form::text('keywords',null, ['class' => 'form-control' , 'placeholder'=>'SEO - Keywords']) !!}
								</div>
							</div>
						</div>

						<div class="tab-pane" id="tab-description">
							<div class="form-group">
								{!! Form::label('description','Description', ['class'=>'col-sm-12 control-label']) !!}
								<div class="col-sm-12">
								{!! Form::textarea('description',null, ['class' => 'form-control','rows'=>'3', 'placeholder'=>'SEO - Description']) !!}
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="ibox float-e-margins">
				<div class="ibox-title">
			        <h5>Logo chính</h5>
			        <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-down"></i>
                        </a>
                    </div>
			    </div>
				<div class="ibox-content">
					<div class="form-group">
						<div class="col-md-12">
							{!! Form::label('logo','Logo') !!}
							<div class="fileinput fileinput-new" style="width: 100%;" data-provides="fileinput">
								<div class="fileinput-preview thumbnail mb20" data-trigger="fileinput" style="width: 100%; height: 150px;">
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
				</div>
			</div>

			<div class="ibox float-e-margins">
				<div class="ibox-title">
			        <h5>Banner Đăng nhập</h5>
			        <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-down"></i>
                        </a>
                    </div>
			    </div>
				<div class="ibox-content">
					<div class="form-group">
						<div class="col-md-12">
							{!! Form::label('banner_login','Banner Login') !!}
							<div class="fileinput fileinput-new" style="width: 100%;" data-provides="fileinput">
								<div class="fileinput-preview thumbnail mb20" data-trigger="fileinput" style="width: 100%; height: 150px;">
									{!! HTML::image( (isset($item) && $item->banner_login )? asset($item->banner_login) :  asset('assets/backend/img/no-image.png'), '') !!}
								</div>
								<div>
									<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Xóa</a>
									<div class="btn btn-default btn-file">
									<span class="fileinput-new">Chọn ảnh</span>
									<span class="fileinput-exists">Thay đôi</span>
									{!! Form::file('banner_login') !!}
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			{{--
			<div class="ibox float-e-margins">
				<div class="ibox-title">
			        <h5>Cấu hình label</h5>
			        <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-down"></i>
                        </a>
                    </div>
			    </div>
				<div class="ibox-content">
					<div class="form-group">
						{!! Form::label('label[0]','Menu', ['class'=>'col-sm-12 control-label']) !!}
						<div class="col-sm-12">
						{!! Form::text('label[0]',$item->label, ['class' => 'form-control' ]) !!}
						</div>
					</div>

					<div class="form-group">
						{!! Form::label('label[1]','Kết nối Umzila', ['class'=>'col-sm-12 control-label']) !!}
						<div class="col-sm-12">
						{!! Form::text('label[1]',null, ['class' => 'form-control' ]) !!}
						</div>
					</div>

					<div class="form-group">
						{!! Form::label('label[2]','Thanh toán', ['class'=>'col-sm-12 control-label']) !!}
						<div class="col-sm-12">
						{!! Form::text('label[2]',null, ['class' => 'form-control' ]) !!}
						</div>
					</div>

					<div class="form-group">
						{!! Form::label('label[3]','Copyright', ['class'=>'col-sm-12 control-label']) !!}
						<div class="col-sm-12">
						{!! Form::text('label[3]',null, ['class' => 'form-control' ]) !!}
						</div>
					</div>
					--}}
				</div>
			</div>

		</div>
		{!! Form::close() !!}
	</div>
</div>
@endsection


@section('body-append')
	@parent
	{!!HTML::script('assets/backend/js/plugins/summernote/dist/summernote.min.js')!!}
	{!!HTML::script('assets/backend/js/plugins/form-jasnyupload/fileinput.min.js')!!}
	<script>
	var flash_message = '{!!session("flash_message")!!}';
	$(function() {
		$('.textarea-summernote').summernote({
			  height:200,
			  callbacks: {
				  onImageUpload: function(files) {
	                    sendFile(files[0]);
	                  	}
	                }
			});
	});
	</script>

@endsection

