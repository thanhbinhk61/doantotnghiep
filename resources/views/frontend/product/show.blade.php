@extends('layouts.frontend')

@section('title',$item->title . ' | ' . $configs->title)
@section('description',$item->description)
@section('keywords',$item->keywords)

@section('head-append')
@parent
    <meta property="og:type" content="product.item" />
    <meta property="og:description" content="Sản phẩm {{$item->description}}" />
    <meta property="og:image" content="{{$item->image}}" />
    <meta property="product:retailer_item_id" content="{{$item->id}}" />
    <meta property="product:price:amount" content="{{$item->price}}" />
    <meta property="product:price:currency" content="VND" />
    <meta property="product:availability" content="available for order" />
    <meta property="product:condition" content="new" />
{!! HTML::style('assets/frontend/threesixty-slider/src/styles/threesixty.css') !!}
{!! HTML::style('assets/frontend/lib/rateyo/jquery.rateyo.min.css') !!}
@endsection

@section('page-content')

@include('frontend._partials.quickview')

<div class="columns-container">
    <div class="container" id="columns">
        <!-- breadcrumb -->
        <div class="breadcrumb clearfix">
            <a class="home" href="/" title="Trang chủ">Trang chủ</a>
            @if (count($item->categoryRoot))
            <span class="navigation-pipe">&nbsp;</span>
            <a href="{{route('product.category',$item->categoryRoot->first()->slug)}}" >{{$item->categoryRoot->first()->name}}</a>
            @endif
            @if(count($item->categoryChildren))
            <span class="navigation-pipe">&nbsp;</span>
            <a href="{{route('product.category',$item->categoryChildren->first()->slug)}}" >{{$item->categoryChildren->first()->name}}</a>
            @endif
        </div>
        <!-- ./breadcrumb -->
        <!-- row open -->
        <!-- row open -->
        <div class="row">
            <!-- Center colunm-->
            <div class="center_column col-xs-12 col-sm-9 pull-left" id="center_column">
                <!-- Product -->
                    <div id="product">
                        <div class="primary-box row">
                            <div class="pb-left-column col-xs-12 col-sm-6">
                                <!-- product-imge-->
                                <div class="product-image">
                                    <div class="product-full">
                                        <img id="product-zoom" src="{{route('image.resize',[$item->image,480,480])}}" data-zoom-image="{{asset($item->image)}}"/>
                                    </div>
                                    <div class="product-img-thumb" id="gallery_01">
                                        @if (count($item->galleryImages) > 0)
                                        <ul class="owl-carousel" data-items="3" data-nav="true" data-dots="false" data-margin="20" data-loop="false">
                                            @foreach($item->galleryImages as $gallery)
                                            <li>
                                                <a href="#" data-image="{{route('image.resize',[$gallery->image,480,480])}}" data-zoom-image="{{asset($gallery->image)}}">
                                                    <img id="product-zoom"  src="{{route('image.resize',[$gallery->image,100,100])}}" /> 
                                                </a>
                                            </li>
                                            @endforeach
                                        </ul>
                                        @endif
                                    </div>
                                </div>
                                <!-- product-imge-->
                            </div>
                            <div class="pb-right-column col-xs-12 col-sm-6">
                                <h1 class="product-name">{{$item->name}}</h1>
                                <div class="product-comments">
                                    <div class="product-star">
                                        @for ($star = 1; $star < 6; $star++)
                                        <i class="{{(count($item->getRating) && $star <= $item->getRating->first()->rating )? 'fa fa-star' : 'fa fa-star-o' }} "></i>
                                        @endfor
                                    </div>
                                </div>
                                <div class="product-price-group">
                                	@if ($item->sale == 2)
                                    <span class="price change-price">{{number_format($item->price_sale)}} ₫</span>
                                    <span class="old-price">{{number_format($item->price)}} ₫</span>
                                    <span class="discount">-{{100-round(($item->price_sale/$item->price)*100)}}%</span>
                                	@else
                                	<span class="price change-price">{{number_format($item->price)}} ₫</span>
                                	@endif
                                </div>
                                <div class="info-orther">
                                    <p>Mã sản phẩm: {{$item->code}}</p>
                                    @if ($item->status == 3)
                                    <p>Tình trạng: <span class="in-stock">Hết hàng</span></p>
                                    @endif
                                    @if (count($item->brand))
                                    <p>Thương hiệu: <a href="{{route('brand.product',$item->brand->id)}}"> {{$item->brand->name}} </a></p>
                                    @endif
                                    @if (count($item->provider))
                                    <span >Nhà cung cấp: </span><a href="{{route('product.provider',$item->provider->slug)}}">{{$item->provider->name}}</a>
                                    @endif
                                </div>
                                <div class="product-desc">
                                    {{$item->intro}}
                                </div>
                                @if ($item->status != 3)
                                <div class="form-option">
                                    @if (count($item->colors) > 1)
                                    <div class="attributes">
                                        <div class="attribute-label">Màu sắc:</div>
                                        <div class="attribute-list">
                                            {{Form::hidden('color')}}
                                            {{Form::hidden('color_id')}}
                                            <ul class="list-color">
                                                @foreach ($item->colors as $color)
                                                <li class="select"><a data-price="{{$color->pivot->price}}" data-id="{{$color->id}}" class="select-color" href="#">{{$color->name}}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    @endif
                                    @foreach($item->others->groupBy('category_id') as $key => $oProperty)
                                    @if (count($oProperty) > 1)
                                    <div class="attributes">
                                        <div class="attribute-label">{{ $categoryProperty->keyBy('id')[$key]['name'] }}: </div>
                                        <div class="attribute-list">
                                            <select class="property-group" name ="property[{{$key}}]">
                                                @foreach($oProperty as $property)
                                                <option value="{{$property->id}}" data-price="{{$property->pivot->price}}">{{$property->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                    <div class="attributes">
                                        <div class="attribute-label">Số lượng:</div>
                                        @if ($item->quantity > 0)
                                        <div class="attribute-list product-qty">
                                            <div class="qty">
                                                <input class="option-product-qty" type="number" value="1">
                                            </div>
                                        </div>
                                        @else
                                            <span class="text-danger">Hết hàng</span>
                                        @endif
                                    </div>
                                </div>
                                @if ($item->quantity > 0)
                                <div class="form-action">
                                    <div class="button-group">
                                        <a class="btn-add-cart add-form-cart-store"  href="{{route('product.cart.store',$item->id)}}">Thêm vào giỏ</a>
                                    </div>
                                </div>
                                @endif
                                @endif
                            </div>
                        </div>
                        <!-- tab product -->
                        <div class="product-tab">
                            <ul class="nav-tab">
                                <li class="active">
                                    <a aria-expanded="false" data-toggle="tab" href="#product-detail">Chi tiết sản phẩm</a>
                                </li>

                                @if (count($item->rotateImages))
                                <li>
                                    <a href="#threesixty" aria-expanded="true" data-toggle="tab">Ảnh xoay 3D</a>
                                </li>
                                @endif

                                @if ($item->video)
                                <li>
                                    <a aria-expanded="true" data-toggle="tab" href="#video">Video trải nghiệm</a>
                                </li>
                                @endif
                                <li>
                                    <a aria-expanded="true" data-toggle="tab" href="#comment">Đánh giá sản phẩm</a>
                                </li>

                            </ul>
                            <div class="tab-container">
                                <div id="product-detail" class="tab-panel active">
                                    <table class="table table-bordered">
                                        @if (count($item->colors))
                                        <tr>
                                            <td width="200">Màu sắc</td>
                                            <td>{{$item->colors->implode('name',', ')}}</td>
                                        </tr>
                                        @endif
                                        
                                        @foreach($item->others->groupBy('category_id') as $key => $oProperty)
                                        <tr>
                                            <td>{{ $categoryProperty->keyBy('id')[$key]['name'] }}</td>
                                            <td>{{ $oProperty->implode('name', ', ') }}</td>
                                        </tr>
                                        @endforeach
                                        @if ($item->brand_id != 0)
                                        <tr>
                                            <td>Thương hiệu</td>
                                            <td>{{isset($item->brand) ? $item->brand->name : ''}}</td>
                                        </tr>
                                        @endif
                                        @if ($item->provider_id)
                                        <tr>
                                            <td>Nhà cung cấp</td>
                                            <td>{{isset($item->provider) ? $item->provider->name : ''}}</td>
                                        </tr>
                                        @endif
                                    </table>
                                    <p>{!!$item->content!!}</p>
                                </div>
                                <div id="comment" class="tab-panel">
                                    {!! Form::open(['url' => route('product.comment.store'),'class' => 'form-horizontal coment-form', 'autocomplete'=>'off']) !!}
                                    {!! Form::hidden('product_id',$item->id)!!}
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label for="message">Lời nhắn</label>
                                            <textarea name="content"row="3" class="form-control"></textarea>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label for="name">Tên của bạn</label>
                                                    <input name="name" type="text" class="form-control">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="email">Địa chỉ Email</label>
                                                    <input name="email" type="email" class="form-control">
                                                </div>
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                {!! Form::label('vote','Đánh giá', ['class'=>'col-sm-6']) !!}
                                                <div class="col-sm-6">
                                                    {!!Form::hidden('vote',5)!!}
                                                    <div id="rateYo"></div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn-comment">Gửi bình luận</button>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="slim-scroll">
                                                <div class="product-comments-block-tab">
                                                    @if (count($item->commentActive))
                                                    @foreach($item->commentActive as $comment)
                                                    <div class="comment row">
                                                        <div class="col-sm-3 author">
                                                            <div class="info-author">
                                                                <p><strong>{{$comment->name}}</strong></p>
                                                                <em>{{$comment->created_at->diffForHumans()}}</em>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-9 commnet-dettail">
                                                            {{$comment->content}}
                                                            <div class="grade">
                                                                <span>Đánh giá</span>
                                                                <span class="reviewRating">
                                                                    @for ($star = 1; $star < 6; $star++)
                                                                    <i class="{{($star <= $comment->vote )? 'fa fa-star' : 'fa fa-star-o' }} "></i>
                                                                    @endfor
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>       
                                    {!!Form::close()!!}
                                </div>
                                @if ($item->video)
                                <div id="video" class="tab-panel text-center">
                                    <iframe width="560" height="315" src="http://www.youtube.com/embed/{{$item->video}}?rel=0&controls=0&showinfo=0" frameborder="0" allowfullscreen></iframe>
                                </div>
                                @endif

                                @if (count($item->rotateImages))
                                <div id="threesixty" class="tab-panel text-center">
                                    <div class="mfp-dialog" id="threesixty-dialog">
                                        <div class="pull-right">
                                            <ul class="product-page-actions-list">
                                                <li><a data-action="prev" class="btn btn-default" href="#"><i class="fa fa-backward"></i></a>
                                                </li>
                                                <li><a data-action="play" class="btn btn-primary" href="#"><i class="fa fa-pause"></i> <span class="hidden-xs">Xoay</span></a>
                                                </li>
                                                <li><a data-action="next" class="btn btn-default" href="#"><i class="fa fa-forward"></i> </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="threesixty threesixty-product">
                                            <div class="spinner">
                                                <span>0%</span>
                                            </div>
                                            <ol class="threesixty_images"></ol>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        <!-- ./tab product -->
                        <!-- box product -->
                        <div class="page-product-box">
                            <h3 class="heading">Sản phẩm cùng danh mục</h3>
                            <ul class="product-list owl-carousel" data-dots="false" data-lazy-load="true" data-loop="true" data-nav = "true" data-margin = "30" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":3}}'>
                                @foreach($productSame as $same)
                                <li>
                                    <div class="product-container">
                                        <div class="left-block">
                                            <a href="{{route('product.show',$same->slug)}}">
                                                <img class="img-responsive owl-lazy" alt="product" width="250" height="250" data-src="{{route('image.resize',[$same->image,300,300])}}" />
                                            </a>
                                            <div class="quick-view ">
                                                    <a title="yêu thích" class="heart wish-list" href="{{ empty($me) ? route('auth.login') : route('customer.wishlist.add',$same->id) }}"></a>
                                                    <a title="Xem nhanh"  class="search click-quickview" data-quickview="{{$same->id}}" href="#product-quickview"></a>
                                            </div>
                                        </div>
                                        <div class="right-block">
                                            <h5 class="product-name"><a href="{{route('product.show',$same->slug)}}">{{str_limit($same->name,55)}}</a></h5>
                                            <div class="product-star">
                                                @for ($star = 1; $star < 6; $star++)
                                                <i class="{{(count($same->getRating) && $star <= $same->getRating->first()->rating )? 'fa fa-star' : 'fa fa-star-o' }} "></i>
                                                @endfor
                                            </div>
                                            <div class="content_price">
                                            	@if ($same->sale == 2)
                                                <span class="price product-price">{{number_format($same->price_sale)}} ₫</span>
                                                <span class="price old-price">{{number_format($same->price)}} ₫</span>
                                                @else 
                                                <span class="price product-price">{{number_format($same->price)}} ₫</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- ./box product -->
                    </div>
                <!-- Product -->
            </div>
            <!-- ./ Center colunm -->
            <!-- Left colunm -->
            <div class="column col-xs-12 col-sm-3 pull-right" id="left_column">
                
                <!-- block category -->
                <div class="block left-module">
                    <p class="title_block">Danh mục</p>
                    <div class="block_content">
                        <!-- layered -->
                        <div class="layered layered-category">
                            <div class="layered-content">
                                <ul class="tree-menu">
                                    @foreach($categoryRoots as $cateRoot)
                                    <li class="@if(count($cateRoot->children) > 0) active @endif ">
                                        <span></span><a href="{{route('product.category',$cateRoot->slug)}}">{{$cateRoot->name}}</a>
                                        @if (count($cateRoot->children) > 0)
                                        <ul style="display:block">
                                            @foreach ($cateRoot->children as $children)
                                            <li><span></span><a href="{{route('product.category',$children->slug)}}">{{$children->name}}</a></li>
                                            @endforeach
                                        </ul>
                                        @endif
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <!-- ./layered -->
                    </div>
                </div>
                <!-- ./block category  -->
                @include('frontend._partials.random')
                @include('frontend._partials.sale')
            </div>
            <!-- ./right colunm -->
        </div>
        <!-- ./row-->
    </div>
</div>
@endsection

@section('body-append')
	@parent
    {!! HTML::script('assets/frontend/lib/jquery.elevatezoom.js') !!}
	{!! HTML::script('assets/frontend/lib/rateyo/jquery.rateyo.min.js') !!}
	{!!HTML::script('assets/frontend/threesixty-slider/dist/threesixty.min.js')!!}
    {{ HTML::script("assets/backend/js/plugins/slimscroll/jquery.slimscroll.min.js") }}
	<script>
        var quantity = {{$item->quantity}};
		var threesixtyProducts;
	    var imgArray = [];
	    var threesixtyImages = <?php echo $item->rotateImages ? $item->rotateImages->toJson() : "''"?>;
	    $.each(threesixtyImages, function (key, index) {
	        imgArray.push('/'+index.image);
	    });

	    function sliderStop(slider)
	    {
	        $("#threesixty-dialog [data-action='play']").removeClass('is-playing').html('<i class="fa fa-play"></i> Xoay');
	        slider.stop();
	    }

	    function sliderPlay(slider)
	    {
	        $("#threesixty-dialog [data-action='play']").addClass('is-playing').html('<i class="fa fa-pause"></i> Dừng');
	        slider.play();
	    }
	    function init360 () {
	        var framerate = 30;
	        threesixtyProducts = $('.threesixty-product').ThreeSixty({
	            totalFrames: threesixtyImages.length, // Total no. of image you have for 360 slider
	            endFrame: threesixtyImages.length, // end frame for the auto spin animation
	            currentFrame: 1, // This the start frame for auto spin
	            imgList: '.threesixty_images', // selector for image list
	            progress: '.spinner', // selector to show the loading progress
	            filePrefix: '', // file prefix if any
	            height: 450,
	            width: 450,
	            navigation: true,
	            responsive: true,
	            // framerate: framerate,
	            imgArray: imgArray,
	        });

	        // sliderPlay(threesixtyProducts);


	        $("#threesixty-dialog [data-action='prev']").bind('click', function(e) {
                e.preventDefault();
	            sliderStop(threesixtyProducts);
	            threesixtyProducts.previous();
	        });

	        $("#threesixty-dialog [data-action='play']").bind('click', function(e) {
                e.preventDefault();
	            if ($(this).is('.is-playing')) {
	                return sliderStop(threesixtyProducts);
	            }
	            sliderPlay(threesixtyProducts);
	        });

	        $("#threesixty-dialog [data-action='next']").bind('click', function(e) {
                e.preventDefault();
	            sliderStop(threesixtyProducts);
	            threesixtyProducts.next();
	        });
	    }
		$(function (){
			$('body').removeClass('home');
			$('.columns-container').css("background","#fff");
            $("#rateYo").rateYo({
                rating: 5,
                fullStar: true
            }).on("rateyo.set", function (e, data) {
                $('input[name="vote"]').val(data.rating);
              });

            $('.slim-scroll').slimscroll({
                height: 300
            });

            $('.option-product-qty').change(function () {
                if ($(this).val() > quantity) {
                    $(this).val(quantity);
                }
                if ($(this).val() < 0) {
                    $(this).val(0);
                }
            });

            var listedPrice = parseCurrency($('.change-price').text());
            var changePrice = 0;
            var idsArray = [];
            $('.property-group').find("option:selected").map(function() {
                changePrice += $(this).data('price');
                idsArray.push($(this).val());
            });
            $('.change-price').text(localeString(listedPrice + changePrice) + ' ₫');
            var color_id = 0;
            $('.select-color').click(function (e) {
                //var color_id = 0;
                e.preventDefault();
                $('.has-warning').text('');
                $('.select').removeClass('active')
                $(this).parent().addClass('active');
                color_id = $(this).data('id');
                if ($(this).data('price') != 0) {
                    $('.change-price').text(localeString(listedPrice + $(this).data('price')) + ' ₫');
                }
			});
            $('.property-group').change(function () {
                idsArray = [];
                var optionCheck = false;
                $(this).find("option").map(function () {
                    if ($(this).data('price') > 0) optionCheck = true;
                });
                if (optionCheck) {
                    $('.change-price').text(localeString(listedPrice + $(this).find("option:selected").data('price')) + ' ₫');
                }
                $('.property-group').find("option:selected").map(function () {
                    idsArray.push($(this).val());
                });
            });

            $('.add-form-cart-store').click(function (e) {
                e.preventDefault();
                var priceFinal = parseCurrency($('.change-price').text());
                // if (!$('input[name="color"]').val() || $('input[name="color"]').val() === 'undefined') {
                //     $('.has-warning').text('Bạn chưa chọn màu.');
                //     return;
                // }
                var dataCart = {_method:"POST",quantity:$('.option-product-qty').val(), color_id:color_id,'other_ids':idsArray,'price':priceFinal}
                $.post($(this).attr('href'), dataCart, function (data) {
                    //console.log(data);
                    window.location.reload();
                });
            });	

            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            var target = $(e.target).attr("href");
                if ((target == '#threesixty')) {
                    if (!$(this).data('already-shown')) {
                         init360(); 
                         $(this).data('already-shown',1);
                     }
                }else{
                    if (threesixtyProducts) {
                         sliderStop(threesixtyProducts);
                    }
                }
            });
		});
	</script>
@endsection