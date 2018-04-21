@extends('layouts.frontend')

@section('page-slide')
  @include('frontend._partials.slide')
@stop
@section('page-content')

@foreach($categoryRoot as $category)
<?php $category->load('productNew','productSpecial') ?>
<div class="box-products new-arrivals">
    <div class="container">
        <div class="box-product-head" style="border-bottom:1px solid {{$category->color}}">
            <span class="box-title"><a href="{{route('product.category',$category->slug)}}">{{$category->name}}</a></span>
            <ul class="box-tabs nav-tab">
                <li class="active"><a data-toggle="tab" href="#tab-{{$category->id}}1">Hàng mới về</a></li>
                <li><a data-toggle="tab" href="#tab-{{$category->id}}2">khuyến mại</a></li>
            </ul>
        </div>
        <div class="box-product-content">
            <div class="box-product-adv">
                <ul>
                    <li><a href="{{route('product.category',$category->slug)}}"><img width="226" height="340" src="{{ $category->image ? route('image.resize',[$category->image,226,340]) : route('image.resize',['assets/frontend/images/no-image.png',226,340])}}" alt="{{$category->name}}"></a></li>
                </ul>
            </div>
            <div class="box-product-list">
                <div class="tab-container">
                    <div id="tab-{{$category->id}}1" class="tab-panel active">
                        <ul class="product-list owl-carousel nav-center" data-dots="false" data-loop="true" data-lazy-load="true" data-nav = "true" data-margin = "10" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":4}}'>
                            @foreach($category->productNew as $productNew)
                            <li>
                                <div class="left-block">
                                    <a href="{{route('product.show',$productNew->slug)}}"><img class="img-responsive owl-lazy" width="250" height="250" data-src="{{route('image.resize',[$productNew->image,300,300])}}" alt="{{$productNew->name}}" /></a>
                                    <div class="quick-view">
                                        <a class="heart wish-list" href="{{ empty($me) ? route('auth.login') : route('customer.wishlist.add',$productNew->id) }}"></a>
                                        <a data-quickview="{{$productNew->id}}" href="#product-quickview" class="search click-quickview" ></a>
                                    </div>
                                </div>
                                <div class="right-block">
                                    <h5 class="product-name"><a @if (strlen($productNew->name) > 65) title="{{$productNew->name}}" @endif href="{{route('product.show',$productNew->slug)}}">{{str_limit($productNew->name,65)}}</a></h5>
                                    <div class="content_price">
                                        @if ($productNew->sale == 2)
                                        <span class="price product-price">{{number_format($productNew->price_sale)}} ₫</span>
                                        <span class="price old-price">{{number_format($productNew->price)}} ₫</span>
                                        @else 
                                        <span class="price product-price">{{number_format($productNew->price)}} ₫</span>
                                        @endif
                                    </div>
                                </div>
                                @if ($productNew->sale == 2 && $productNew->price != 0)
                                <div class="price-percent-reduction2">
                                    -{{100-round(($productNew->price_sale/$productNew->price)*100)}}%
                                </div>
                                @endif
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div id="tab-{{$category->id}}2" class="tab-panel">
                        <ul class="product-list owl-carousel" data-dots="false" data-loop="true" data-nav = "true" data-lazy-load="true" data-margin = "10" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":4}}'>
                            @foreach($category->productSpecial as $productSpecial)
                            <li>
                                <div class="left-block">
                                    <a href="{{route('product.show',$productSpecial->slug)}}"><img class="img-responsive owl-lazy" width="250" height="250" data-src="{{route('image.resize',[$productSpecial->image,300,300])}}" alt="{{$productSpecial->name}}" /></a>
                                    <div class="quick-view">
                                        <a class="heart wish-list" href="{{ empty($me) ? route('auth.login') : route('customer.wishlist.add',$productSpecial->id) }}"></a>
                                        <a data-quickview="{{$productSpecial->id}}" href="#product-quickview" class="search click-quickview" ></a>
                                    </div>
                                </div>
                                <div class="right-block">
                                    <h5 class="product-name"><a @if (strlen($productSpecial->name) > 65) title="{{$productNew->name}}" @endif href="{{route('product.show',$productSpecial->slug)}}">{{str_limit($productSpecial->name,65)}}</a></h5>
                                    <div class="content_price">
                                        @if ($productSpecial->sale == 2)
                                        <span class="price product-price">{{number_format($productSpecial->price_sale)}} ₫</span>
                                        <span class="price old-price">{{number_format($productSpecial->price)}} ₫</span>
                                        @else 
                                        <span class="price product-price">{{number_format($productSpecial->price)}} ₫</span>
                                        @endif
                                    </div>
                                </div>
                                @if ($productSpecial->sale == 2 && $productSpecial->price != 0)
                                <div class="price-percent-reduction2">
                                    -{{100-round(($productSpecial->price_sale/$productSpecial->price)*100)}}%
                                </div>
                                @endif
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@include('frontend._partials.quickview')
<div class="row-blog">
    <div class="container">
        <!-- blog list -->
        @foreach($postFeature as $pFeature)
        <div class="blog-list">
            <h2 class="page-heading">
                <span class="page-heading-title"><a href="{{route('post.category',$pFeature->slug)}}">{{$pFeature->name}}</a></span>
            </h2>
            <div class="blog-list-wapper">
                <ul class="owl-carousel" data-dots="false" data-loop="true" data-nav = "true" data-margin = "30" data-lazy-load="true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":4}}'>
                    @foreach($pFeature->postHome as $post)
                    <li>
                        <div class="post-thumb image-hover2">
                            <a href="{{route('post.show',$post->slug)}}"><img class="owl-lazy" data-src="{{route('image.resize',[$post->image,270,257])}}" alt="{{$post->name}}"></a>
                        </div>
                        <div class="post-desc">
                            <h5 class="post-title">
                                <a href="{{route('post.show',$post->slug)}}">{{$post->name}}</a>
                            </h5>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endforeach

        @if(count($providers) > 1)
        <div class="row-brand">
            <h2 class="page-heading">
                <span class="page-heading-title"><a href="{{route('provider.index')}}">Nhà cung cấp</a></span>
            </h2>
            <ul class="band-logo owl-carousel"  data-dots="false" data-loop="true" data-nav = "true" data-margin = "4" data-responsive='{"0":{"items":3},"600":{"items":5},"1000":{"items":8}}'>
                @foreach($providers as $provider)
                <li>
                    <a href="{{route('product.provider',$provider->slug)}}"><img src="{{ $provider->logo ? route('image.resize',[$provider->logo,144,66]) : route('image.resize',['assets/frontend/images/1.jpg',144,66])}}" alt="{{$provider->name}}"></a>
                </li>
                @endforeach    
            </ul>
        </div>
        @endif   

        <div class="row-brand">
            <h2 class="page-heading">
                <span class="page-heading-title"><a href="{{route('brand.index')}}">Thương hiệu</a></span>
            </h2>
            <ul class="band-logo owl-carousel"  data-dots="false" data-loop="true" data-lazy-load="true" data-nav = "true" data-margin = "2" data-responsive='{"0":{"items":3},"600":{"items":5},"1000":{"items":8}}'>
                @if(count($brands) > 1)
                @foreach($brands->chunk(2) as $chunks)
                <li>
                    @foreach($chunks as $brand)
                    <a href=" #{{-- {{route('brand.product',$brand->id)}} --}}"><img class="owl-lazy" data-src="{{ $brand->logo ? route('image.resize',[$brand->logo,144,66]) : route('image.resize',['assets/frontend/images/1.jpg',144,66])}}" alt="{{$brand->name}}"></a>
                    @endforeach
                </li>
                @endforeach    
                @endif            
            </ul>
        </div>
    </div>
</div>
@include('frontend._partials.viewed')

@stop