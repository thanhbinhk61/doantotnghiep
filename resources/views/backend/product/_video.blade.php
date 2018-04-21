<div class="ibox float-e-margins">
	<div class="ibox-title">
        <h5>Video Trải nghiệm</h5>
        <div class="ibox-tools">
            <a class="collapse-link">
                <i class="fa fa-chevron-down"></i>
            </a>
        </div>
    </div>
	<div class="ibox-content">
		<div class="form-group">
            {!! Form::label('video','Video', ['class'=>'col-sm-12 control-label']) !!}
            <div class="col-sm-12">
            {!! Form::text('video',(isset($item) && $item->video) ? 'https://www.youtube.com/watch?v=' . $item->video : Null, ['class' => 'form-control','placeholder'=>'Link youtube']) !!}
            </div>
        </div>
		@if (isset($item) && $item->video)
		<div class="form-group">
			<div class="col-md-12">
				<div class="fileinput fileinput-new" style="width: 100%;" data-provides="fileinput">
					<div class="fileinput-preview thumbnail mb20" data-trigger="fileinput" style="width: 100%; height: 150px;">
						<iframe width="220" height="220" src="http://www.youtube.com/embed/{{$item->video}}?rel=0&controls=0&showinfo=0" frameborder="0" allowfullscreen></iframe>
					</div>
				</div>
			</div>
		</div>
		@endif
	</div>
</div>
