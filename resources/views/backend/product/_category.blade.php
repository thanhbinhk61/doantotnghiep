<div class="ibox float-e-margins">
	<div class="ibox-title">
        <h5>Danh mục</h5>
        <div class="ibox-tools">
            <a class="collapse-link">
                <i class="fa fa-chevron-down"></i>
            </a>
        </div>
    </div>
	<div class="ibox-content">
		<div class="form-group">
			<div class="col-md-12">
				<div class="slim-scroll">
					<table class="table">
						<tbody>
							@foreach($categories as $id => $name)
								<?php
									$checked = (isset($item) && isset($item->categories->keyBy('id')[$id])) ? true : false;
								?>
								<tr>
									<td>{!! Form::checkbox('cate_id[]', $id, $checked,['class'=>'checkbox-category']) !!}</td>
									<td>{!!$name !!}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>