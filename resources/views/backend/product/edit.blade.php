@extends('layouts.backend')

@section('title',isset($heading) ? $heading : 'Cập nhật')

@section('page-content')
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		{!! Form::model($item, ['method' => 'PATCH', 'url' => route('admin.product.update', $item->id), 'files' => true, 'class' => 'form-horizontal', 'autocomplete'=>'off','id' => 'main-form']) !!}
		<div class="col-sm-8">
			@include('backend.product._form')   
			@include('backend.product._album')    
			@if (count($item->comments))    
			@include('backend.product._comment')
			@endif    
		</div>
		<div class="col-sm-4">
			@include('backend.product._seo') 
			@include('backend.product._video') 
			@include('backend.product._image') 
			@include('backend.product._category')
			@include('backend.product._property')
			
		</div>
		{!! Form::close() !!}
	</div>
</div>
@endsection
@section('body-append')
<script>
var flash_message = '{!!session("flash_message")!!}';
var galleryImages = <?php echo $item->galleryImages ? $item->galleryImages->map(function($image) {
	$image['src'] = route('image.resize',[$image->image,200,200]);
	return $image;
})->toJson() : "''"?>;
var galleryRotate = <?php echo $item->rotateImages ? $item->rotateImages->map(function($image) {
	$image['src'] = route('image.resize',[$image->image,200,200]);
	return $image;
})->toJson() : "''"?>;

</script>
@parent

@endsection