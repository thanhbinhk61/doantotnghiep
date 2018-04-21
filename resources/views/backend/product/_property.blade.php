<div class="ibox float-e-margins border-bottom">
	<div class="ibox-title">
        <h5>Màu sắc</h5>
        <div class="ibox-tools">
            <a class="collapse-link">
                <i class="fa fa-chevron-up"></i>
            </a>
        </div>
    </div>
	<div class="ibox-content" style="display: none">
		<div class="form-group">
			<div class="col-md-12">
				<div class="slim-scroll-100">
					<table class="table middle-align">
						<thead>
							<th>Chọn</th>
							<th>Tên</th>
							<th width="150px"> (+) hoặc (-) giá</th>
						</thead>
						<tbody>
							@foreach($colorList as $id => $name)
								<?php
									$checked = (isset($item) && isset($item->colors->keyBy('id')[$id])) ? true : false;
									$priceChange = (isset($item) && isset($item->colors->keyBy('id')[$id])) ? $item->colors->keyBy('id')[$id]['pivot']['price'] : 0;
								?>
								<tr>
									<td >{!! Form::checkbox('color_id[]', $id, $checked,['class'=>'checkbox']) !!}</td>
									<td >{!! $name !!}</td>
									<td >{!! Form::text('color_price['.$id.']', $priceChange, ['class' => 'form-control touchspin','placeholder'=>'']) !!}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<?php 
	$groupProperty->load('properties');
?>
@foreach ($groupProperty as $group)
<div class="ibox float-e-margins border-bottom">
	<div class="ibox-title">
        <h5>{{$group->name}}</h5>
        <div class="ibox-tools">
            <a class="collapse-link">
                <i class="fa fa-chevron-up"></i>
            </a>
        </div>
    </div>
	<div class="ibox-content" style="display: none">
		<div class="form-group">
			<div class="col-md-12">
				<div class="slim-scroll-100">
					<table class="table middle-align">
						<thead>
							<th>chọn</th>
							<th>Tên</th>
							<th width="150px"> (+) hoặc (-) giá</th>
						</thead>
						<tbody>
							@foreach($group->properties->lists('name','id') as $id => $name)
								<?php
									$checked = (isset($item) && isset($item->properties->keyBy('id')[$id])) ? true : false;
									$pricePropertyChange = (isset($item) && isset($item->properties->keyBy('id')[$id])) ? $item->properties->keyBy('id')[$id]['pivot']['price'] : 0;
								?>
								<tr>
									<td >{!! Form::checkbox('property_id[]', $id, $checked,['class'=>'checkbox']) !!}</td>
									<td >{!! $name !!}</td>
									<td >{!! Form::text('property_price['.$id.']', $pricePropertyChange, ['class' => 'form-control touchspin','placeholder'=>'']) !!}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endforeach