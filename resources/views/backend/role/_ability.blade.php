<div class="ibox float-e-margins">
	<div class="ibox-title">
        <h5>Nhóm người dùng</h5>
        <div class="ibox-tools">
            <a class="collapse-link">
                <i class="fa fa-chevron-down"></i>
            </a>
        </div>
    </div>
	<div class="ibox-content">
		<div class="slim-scroll">
			@foreach($abilities as $key=>$group)
			<div class="form-group">
				<label class="col-sm-12"> {{ ucfirst(trans('repositories.' . $key))}}</label>
				@foreach($group->lists('name','id') as $id => $name)
					<?php
						$checked = (isset($item) && isset($item->abilities->keyBy('id')[$id])) ? true : false;
					?>
					<div class="col-sm-11 col-sm-offset-1">
						<label class="checkbox">
							{!! Form::checkbox('ability_id[]', $id, $checked) !!}
							{!!$name !!}
						</label>
					</div>
				@endforeach
			</div>
			@endforeach
		</div>
	</div>
</div>