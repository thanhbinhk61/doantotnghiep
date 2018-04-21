@section('head-append')
	@parent
	{!!HTML::style('assets/backend/js/plugins/summernote/dist/summernote.css')!!}
	{!!HTML::style('assets/backend/js/plugins/dropzone/dropzone.min.css')!!}
    {!!HTML::style('assets/backend/css/plugins/select2/select2.min.css')!!}
	{!!HTML::style('assets/backend/css/plugins/touchspin/jquery.bootstrap-touchspin.min.css')!!}
	<style>
    .dropzone {
        border: none!important;
        background-color: transparent!important;
    }
    .dropzone.dz-clickable .dz-message{
        border: 2px dashed #0087F7;
        background-color: #f5f5f5;
        padding: 4em 0;
        margin:0;
    }
    .dropzone .dz-preview.dz-image-preview {
        background-color: #f5f5f5;
        padding: .5em;
        margin:0;
        margin-right: 1em;
        margin-top: 1em;
    }
    .dropzone .dz-preview .dz-image {
        border-radius: 0;
        /*width: 80px;
        height: 80px;*/
    }
    .dropzone .dz-preview .dz-image img {
        max-width: 100%;
    }
    </style>
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
			{!! Form::label('name','Tiêu đề', ['class'=>'col-sm-2 control-label']) !!}
			<div class="col-sm-8">
			{!! Form::text('name',null, ['class' => 'form-control','required','placeholder'=>'Bắt buộc']) !!}
			</div>
		</div>

		<div class="form-group">
			{!! Form::label('code','Code', ['class'=>'col-sm-2 control-label']) !!}
			<div class="col-sm-4">
			{!! Form::text('code',null, ['class' => 'form-control','required','placeholder'=>'Bắt buộc']) !!}
			</div>

            {!! Form::label('quantity','Số lượng', ['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-2">
            {!! Form::text('quantity',null, ['class' => 'form-control currency-mask']) !!}
            </div>
		</div>

		<div class="form-group">
			{!! Form::label('tags','Tags', ['class'=>'col-sm-2 control-label']) !!}
			<div class="col-sm-8">
			{!! Form::text('tags',null, ['class' => 'form-control']) !!}
			</div>
		</div>

		<div class="form-group">
			{!! Form::label('price','Giá', ['class'=>'col-sm-2 control-label']) !!}
			<div class="col-sm-4">
				<div class="input-group">
					<span class="input-group-addon">{!! Form::radio('sale',1,true) !!}</span>
					{!! Form::text('price',null, ['class' => 'form-control currency-mask','required','placeholder'=>'Niêm yết']) !!}
				</div>
			</div>
			<div class="col-sm-4">
				<div class="input-group">
					<span class="input-group-addon">{!! Form::radio('sale',2) !!}</span>
					{!! Form::text('price_sale',null, ['class' => 'form-control currency-mask','placeholder'=>'Khuyến mại']) !!}
				</div>
			</div>
		</div>

		<div class="form-group">
			{!! Form::label('intro','Giới thiệu', ['class'=>'col-sm-2 control-label']) !!}
			<div class="col-sm-8">
			{!! Form::textarea('intro',null, ['class' => 'form-control','rows'=>'3']) !!}
			</div>
		</div>

		<div class="form-group">
			{!! Form::label('content','Nội dung', ['class'=>'col-sm-2 control-label']) !!}
			<div class="col-sm-8">
			{!! Form::textarea('content',null, ['class' => 'form-control textarea-summernote']) !!}
			</div>
		</div>

        <div class="form-group">
            {!! Form::label('section','Phân loại', ['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-8">
                <label class="radio-inline">{!! Form::radio('section',1,true ) !!} Sản phẩm mới</label>
                <label class="radio-inline">{!! Form::radio('section',2 ) !!}  Bình thường</label>
            </div>
        </div>

		<div class="form-group">
			{!! Form::label('status','Trạng  thái', ['class'=>'col-sm-2 control-label']) !!}
			<div class="col-sm-8">
				<label class="radio-inline">{!! Form::radio('status',1,true ) !!}  Hiện trang chủ</label>
				<label class="radio-inline">{!! Form::radio('status',2 ) !!}  Ẩn Trang chủ</label>
				<label class="radio-inline">{!! Form::radio('status',3 ) !!}  Ẩn Hết</label>
			</div>
		</div>
        
        <div class="form-group">
            {!! Form::label('brand_id', 'Thương hiệu', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-md-8">
                {!! Form::select('brand_id', $brandList , isset($item) ? $item->brand_id : null, ['class' => 'form-control select2-demo']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('provider_id', 'Nhà cung cấp', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-md-8">
                {!! Form::select('provider_id', $providerList , null, ['class' => 'form-control select2-demo']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('discount_type','Kiểu chiết khấu', ['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-8">
                <label class="radio-inline">{!! Form::radio('discount_type',1,true ) !!} % giá bán</label>
                <label class="radio-inline">{!! Form::radio('discount_type',2 ) !!}  $ giá bán</label>
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('dícount_price','Giá trị chiết khấu', ['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-8">
            {!! Form::text('discount_price',null, ['class' => 'form-control currency-mask']) !!}
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
	{!!HTML::script('assets/backend/js/plugins/summernote/dist/summernote.min.js')!!}
	{!!HTML::script('assets/backend/js/plugins/dropzone/dropzone.min.js')!!}
    {!!HTML::script('assets/backend/js/plugins/select2/select2.full.min.js')!!}
	{!!HTML::script('assets/backend/js/plugins/touchspin/jquery.bootstrap-touchspin.min.js')!!}

	<script>
		$(function(){
            $('.checkbox-category').change(function() {
                if($(this).is(":checked")) {
                    $.post(laroute.route('admin.category.ajax.parent') ,{id:$(this).val()},function( data ) {
                      $.map(data, function (n) {
                        if(! $(":checkbox.checkbox-category[value="+n+"]").is(':checked')){
                             $(":checkbox.checkbox-category[value="+n+"]").prop("checked","true");
                        }
                      })
                    });
                }
            });

            $('.slim-scroll-100').slimscroll({
                height: 150
            });

            $(".touchspin").TouchSpin({
               step: 1000,
               min: -1000000000,
               max: 1000000000,
            });

	        $(".select2-demo").select2();
			$('.textarea-summernote').summernote({
			  height:200,
			  callbacks: {
				  onImageUpload: function(files) {
	                    sendFile(files[0]);
	                  	}
	                }
			});

			$(".currency-mask").each(function () {
	            $(this).val(toLocaleCurrency($(this).val()));
	            var callback = function ($this) {
	                if ( !$this.val() ) return;
	                $this.data('val', parseCurrency($this.val()));
	                $this.val(toLocaleCurrency($this.data('val')));
	            }
	            $(this).on('change', function (e) {
	                callback($(this));
	            });
	            $(this).keyup(function(e) {
	                if (e.which !== 0) {
	                    callback($(this));
	                }
	            });
	        });

	        var dropzoneURL = laroute.route('admin.product.upload.image');
	        var options = {
            url: dropzoneURL,
            paramName: 'image',
            uploadMultiple: false,
            parallelUploads: 100,
            maxFiles: 200,
            previewTemplate: document.querySelector('#preview-template').innerHTML,
            addRemoveLinks: true,
            dictRemoveFile: 'Remove',
            dictFileTooBig: 'Image is too bid',
            previewsContainer: '#dropzonePreview',
            imageMockingFiles: [],
            imageMocking: function (myDropzone) {
                if (typeof this.options.imageMockingFiles === "object") {
                    $.each(this.options.imageMockingFiles, function (index, value) {
                        var mockFile = { size: 1 };
                        myDropzone.emit("addedfile", mockFile);

                        myDropzone.emit("thumbnail", mockFile, value.src);

                        myDropzone.emit("complete", mockFile);

                        mockFile.id = value.id;
                        $('<input type="hidden" name="'+myDropzone.options.inputFieldName+'[]" value="'+value.id+'"/>').appendTo($("#main-form"));
                    });
                }
            },

            initCallback: function (myDropzone) {
                this.on("addedfile", function (file) {
                    var $form = $(this.element).closest('form');
                    var hash = uuid();
                    file.uuid = hash;
                    $('<input type="hidden" data-uuid="'+hash+'" name="'+myDropzone.options.inputFieldName+'[]"/>').appendTo($("#main-form"));
                    
                    $('[type="submit"]', $form).attr('onclick','javascript:alert("Ảnh đang được tải lên"); return false;');
                });
                this.on("removedfile", function (file) {
                    if (file.id) {
                        $('input[name="'+myDropzone.options.inputFieldName+'[]"][value="'+file.id+'"]').remove();
                    }
                });
            },
            inputFieldName: "images",
            init: function() {
                var myDropzone = this;
                this.options.imageMocking.call(this, myDropzone);
                this.options.initCallback.call(this, myDropzone);
                this.on("queuecomplete", function (file) {
                    var $form = $(this.element).closest('form');
                    $('[type="submit"]', $form).removeAttr('onclick');
                });
            },
            sending: function(file, xhr, formData) {
                formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
                formData.append("type", this.options.inputFieldName == "albumRotate" ? '2' : '1');
            },
            error: function(file, response) {
                if($.type(response) === "string")
                    var message = response;
                else
                    var message = response.message;
                file.previewElement.classList.add("dz-error");
                _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
                _results = [];
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i];
                    _results.push(node.textContent = message);
                }
                return _results;
            },
            success: function(file, done) {
                $('input[data-uuid="'+file.uuid+'"]').val(done.id);
            }
        };
        var albums = (typeof galleryImages !=='undefined') ? galleryImages : [];
        var albumRotate = (typeof galleryRotate !=='undefined') ? galleryRotate : [];
        options.imageMockingFiles = albums;
        Dropzone.options.realDropzone = options;
        var options360 = jQuery.extend(true, {}, options);;
        options360.inputFieldName = "albumRotate";
        options360.previewsContainer = "#rotatePreview";
        options360.imageMockingFiles = albumRotate;
        Dropzone.options.rotateDropzone = options360;

		});
	</script>

@endsection