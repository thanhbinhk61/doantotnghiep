@section('head-append')
	@parent
	{{ HTML::style('assets/backend/css/plugins/datetimepicker/bootstrap-datetimepicker.min.css')}}
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

		<?php
			$disabled = (isset($item)) ? 'disabled' : null
		?>
		<div class="form-group">
			{!! Form::label('type','Phân loại', ['class'=>'col-sm-2 control-label']) !!}
			<div class="col-sm-8">
				<label class="radio-inline">{!! Form::radio('type',1,true,[$disabled] ) !!}  % GT Đơn hàng</label>
				<label class="radio-inline">{!! Form::radio('type',2,[$disabled] ) !!}  $ GT Đơn hàng</label>
			</div>
		</div>

		<div class="form-group">
			{!! Form::label('name','Giá trị', ['class'=>'col-sm-2 control-label']) !!}
			<div class="col-sm-8">
			{!! Form::text('value',null, ['class' => 'form-control currency-mask', $disabled,'placeholder'=>'Giá trị']) !!}
			</div>
		</div>

		<div class="form-group">
			{!! Form::label('name','GTĐH tối thiểu', ['class'=>'col-sm-2 control-label']) !!}
			<div class="col-sm-8">
			{!! Form::text('min',null, ['class' => 'form-control currency-mask', $disabled,'placeholder'=>'Giá trị đơn hàng tối thiểu']) !!}
			</div>
		</div>

		<div class="form-group">
			{!! Form::label('name','Kỳ hạn', ['class'=>'col-sm-2 control-label']) !!}
			<div class="col-sm-8">
			{!! Form::text('expired_at',isset($item) ? date('d-m-Y H:i',strtotime($item->expired_at)) : null, ['class' => 'form-control datetimepicker','placeholder'=>'dd-MM-YYYY']) !!}
			</div>
		</div>

		@if (!isset($item))
		<div class="form-group">
			{!! Form::label('name','Số lượng', ['class'=>'col-sm-2 control-label']) !!}
			<div class="col-sm-8">
			{!! Form::text('quantity',null, ['class' => 'form-control','placeholder'=>'Số lượng mã code']) !!}
			</div>
		</div>
		@endif

		<div class="form-group">
			{!! Form::label('status','Trạng  thái', ['class'=>'col-sm-2 control-label']) !!}
			<div class="col-sm-8">
				<label class="radio-inline">{!! Form::radio('status',1,true ) !!}  Active</label>
				<label class="radio-inline">{!! Form::radio('status',2 ) !!}  Disable</label>
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
	{!!HTML::script('assets/backend/js/plugins/datetimepicker/bootstrap-datetimepicker.js')!!}
	<script>
		$(function(){
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

	        $('.datetimepicker').datetimepicker({todayHighlight: true, format: 'dd-mm-yyyy hh:ii'});
			
		});
	</script>

@endsection