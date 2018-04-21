@section('head-append')
	@parent

@endsection
<div class="ibox float-e-margins">
	<div class="ibox-title">
        <h5>{!!$heading or 'Cập nhật'!!}</h5>
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
	{!!HTML::script('assets/backend/js/plugins/summernote/dist/summernote.min.js')!!}
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
			
		});
	</script>

@endsection