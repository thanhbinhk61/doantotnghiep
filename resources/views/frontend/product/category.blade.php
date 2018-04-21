@extends('layouts.frontend')

@section('title',$category->title . ' | ' . $configs->title)
@section('description',$category->description)
@section('keywords',$category->keywords)


@section('page-content')

@include('frontend._partials.quickview')

<div class="columns-container">
    <div class="container" id="columns">
        <!-- breadcrumb -->
        <div class="breadcrumb clearfix">
            <a class="home" href="/" title="Về trang chủ">Trang chủ</a>
            <span class="navigation-pipe">&nbsp;</span>
            @if (count($category->parent))
            @if (count($category->parent->parent))
            <a href="{{route('product.category',$category->parent->parent->slug)}}" >{{$category->parent->parent->name}}</a>
            <span class="navigation-pipe">&nbsp;</span>
            @endif
            <a href="{{route('product.category',$category->parent->slug)}}" >{{$category->parent->name}}</a>
            <span class="navigation-pipe">&nbsp;</span>
            @endif
            <span class="navigation_page">{{$category->name}}</span>
        </div>
        <!-- ./breadcrumb -->
        <!-- row -->
        <div class="row">
            <!-- Center colunm-->
            <div class="center_column col-xs-12 col-sm-9" id="center_column">
                <!-- category-slider -->
                <div class="category-slider">
                    <ul class="owl-carousel owl-style2" data-autoplayTimeout="1000" data-autoplay="true" data-items="1">
                        @foreach($slides as $slide)
                        <li>
                            <a target="_blank" href="{{$slide->link}}"><img src="{{route('image.resize',[$slide->image,870,288])}}" alt="{{$slide->name}}"></a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <!-- ./category-slider -->

                <!-- view-product-list-->
                <div id="view-product-list" class="view-product-list">
                    <h2 class="page-heading">
                        <span class="page-heading-title">{{$category->name}}</span>
                    </h2>
                    <ul class="display-product-option">
                        <li class="view-as-grid selected">
                            <span>grid</span>
                        </li>
                        <li class="view-as-list">
                            <span>list</span>
                        </li>
                    </ul>
                    <!-- PRODUCT LIST -->
                    <ul class="row product-list grid">
                        @foreach($productCategory as $product)
                        <div class="col-sx-12 col-sm-4">
                            <li class="product-container">
                                <div class="left-block">
                                    <a href="{{route('product.show',$product->slug)}}">
                                        <img class="img-responsive lazy" alt="{{$product->name}}" width="250" height="250" data-original="{{route('image.resize',[$product->image,300,300])}}" />
                                    </a>
                                    <div class="quick-view">
                                            <a title="yêu thích" class="heart wish-list" href="{{ empty($me) ? route('auth.login') : route('customer.wishlist.add',$product->id) }}"></a>
                                            <a title="Xem nhanh" data-quickview="{{$product->id}}" href="#product-quickview" class="search click-quickview"></a>
                                    </div>
                                </div>
                                <div class="right-block">
                                    <h5 class="product-name"><a @if (strlen($product->name) > 55) title="{{$product->name}}" @endif href="{{route('product.show',$product->slug)}}">{{str_limit($product->name,55)}}</a></h5>
                                    <div class="product-star">
                                        @for ($star = 1; $star < 6; $star++)
                                        <i class="{{(count($product->getRating) && $star <= $product->getRating->first()->rating )? 'fa fa-star' : 'fa fa-star-o' }} "></i>
                                        @endfor
                                    </div>
                                    <div class="content_price">
                                        @if ($product->sale == 2)
                                        <span class="price product-price">{{number_format($product->price_sale)}} ₫</span>
                                        <span class="price old-price">{{number_format($product->price)}} ₫</span>
                                        @else 
                                        <span class="price product-price">{{number_format($product->price)}} ₫</span>
                                        @endif
                                    </div>
                                    <div class="info-orther">
                                        <p>Mã sản phẩm: {{$product->code}}</p>
                                        <p class="availability">Tình trạng: <span>{{config('umzila.productSection.'.$product->section)}}</span></p>
                                        <div class="product-desc">
                                            {{$product->intro}}
                                        </div>
                                    </div>
                                </div>
                                @if ($product->sale==2)
                                <div class="price-percent-reduction2" style="right:8px">
                                    -{{100-round(($product->price_sale/$product->price)*100)}}% 
                                </div>
                                @endif
                            </li>
                        </div>
                        @endforeach
                        
                    </ul>
                    <!-- ./PRODUCT LIST -->
                </div>
                <!-- ./view-product-list-->
                <div class="sortPagiBar">
                    <div class="bottom-pagination">
                        <nav>
                        {{$productCategory->render()}}
                        </nav>
                    </div>
                </div>
            </div>
            <!-- ./ Center colunm -->
            <!-- Left colunm -->
            <div class="column col-xs-12 col-sm-3" id="left_column">
                <!-- block category -->
                <div class="block left-module">
                    <p class="title_block">Danh mục</p>
                    <div class="block_content">
                        <!-- layered -->
                        <div class="layered layered-category">
                            <div class="layered-content">
                                <ul class="tree-menu">
                                    <li>
                                        <span></span> <a href="{{route('product.category',$categoryParent->slug )}}">{{ $categoryParent->name }} </a>
                                        <ul style="display:block">
                                            @foreach ($categoryChildren as $cateChildren)
                                            <li class="@if($cateChildren->id == $category->id) active @endif"><span></span><a href="{{route('product.category',$cateChildren->slug)}}">{{$cateChildren->name}}</a> </li>
                                            @endforeach
                                        </ul>
                                    </li>

                                </ul>
                            </div>
                        </div>
                        <!-- ./layered -->
                    </div>
                </div>
                <!-- ./block category  -->
                <!-- block filter -->
                <div class="block left-module">
                    
                    <div class="block_content">
                        <!-- layered -->
                        <div class="layered layered-filter-price">
                            <!-- filter price -->
                            <div class="layered_subtitle">Giá</div>
                            <div class="layered-content slider-range">
                                <?php 
                                    $priceMin = floor($category->productBrand->min('price_sale')/1000);
                                    $priceMax = floor($category->productBrand->max('price')/1000);
                                ?>
                                <div data-label-reasult="Giá: " data-min="{{$priceMin}}" data-max="{{$priceMax}}" data-unit=" 000 ₫" class="slider-range-price" data-value-min="{{ isset($rangePrice[0])? $rangePrice[0] : $priceMin }}" data-value-max="{{ isset($rangePrice[1])? $rangePrice[1] : $priceMax }}"></div>
                                <div class="amount-range-price">Giá: {{ isset($rangePrice[0])? $rangePrice[0] : $priceMin }} 000 - {{ isset($rangePrice[0])? $rangePrice[1] : $priceMax }} 000</div>
                                <span class="amount-rance-filter" data-min="{{ isset($rangePrice[0])? $rangePrice[0] : $priceMin }}" data-max="{{ isset($rangePrice[0])? $rangePrice[1] : $priceMax }}"></span>
                            </div>
                            <!-- ./filter price -->
                            <!-- filter color -->
                            <div class="layered_subtitle">Màu sắc</div>
                            <div class="layered-content filter-color">
                                <ul class="check-box-list check-box-list-color">
                                    <?php 
                                        $category->productBrand->load('colors');
                                    ?>
                                    @foreach($colors as $color)
                                    <?php 
                                        $is_colors = in_array('true', $category->productBrand->map(function ($item, $key) use ($color) {
                                            return count($item->colors->whereLoose('id',$color->id)) > 0 ? true : false;
                                        })->toArray());
                                    ?>
                                    @if ($is_colors)
                                    <li>
                                        <input class="checkbox" data-type="color" type="checkbox" id="{{$color->id}}" name="cc" />
                                        <label for="{{$color->id}}" ><span class="button">{{$color->name}}</span></label>   
                                    </li>
                                    @endif
                                    @endforeach                                    

                                </ul>
                            </div>
                            <!-- ./filter color -->
                            <!-- ./filter brand -->
                            <div class="layered_subtitle">Thương hiệu</div>
                            <div class="layered-content filter-brand">
                                <div class="slim-scroll">
                                    <ul class="check-box-list">
                                        @foreach($brands as $brand)
                                        @if (count($category->productBrand->whereLoose('brand_id',$brand->id)) > 0)
                                        <li>
                                            <input class="checkbox" data-type="brand" type="checkbox" id="{{$brand->id}}" name="cc" />
                                            <label for="{{$brand->id}}">
                                            <span class="button"></span>
                                            {{$brand->name}} ({{count($category->productBrand->whereLoose('brand_id',$brand->id))}})
                                            </label>   
                                        </li>
                                        @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <!-- ./filter brand -->
                        </div>
                        <!-- ./layered -->

                    </div>
                </div>
                <!-- ./block filter  -->
                
                @include('frontend._partials.sale')
            </div>
            <!-- ./left colunm -->
        </div>
        <!-- ./row-->
    </div>
</div>
@include('frontend._partials.viewed')
@endsection

@section('body-append')
    @parent
    {!! HTML::script('assets/frontend/lib/jquery-ui/jquery-ui.min.js') !!}
    {{ HTML::script("assets/backend/js/plugins/slimscroll/jquery.slimscroll.min.js") }}
    {{ HTML::script('assets/backend/js/laroute.js') }}
    <script type="text/javascript">
        $(function (){
            $('body').removeClass('home');
            $('.columns-container').css("background","#fff");
            $('.slim-scroll').slimscroll({
                height: 250
            });
            //var propertyFilter = <?php echo isset($propertyFilter) ? json_encode($propertyFilter) : "[]"?>;
            var colorFilter = <?php echo isset($colorFilter) ? json_encode($colorFilter) : "[]"?>;
            var brandFilter = <?php echo isset($brandFilter) ? json_encode($brandFilter) : "[]"?>;
            $.each(colorFilter, function (index, id) {
                $(':checkbox[id="'+id+'"]').prop('checked','true');
            });
            $.each(brandFilter, function (index, id) {
                $(':checkbox[id="'+id+'"]').prop('checked','true');
            });
            $('.checkbox').change(function(event) {
                var rangePrice = $('span.amount-rance-filter').data('min') + '_' + $('span.amount-rance-filter').data('max');
                var idsColor = $(':checkbox[data-type="color"]:checked').map(function() { return $(this).attr('id');}).get();
                var colors = (idsColor && idsColor.length) ? idsColor.join('_') : 0;
                var idsBrand = $(':checkbox[data-type="brand"]:checked').map(function() { return $(this).attr('id');}).get();
                var brands = (idsBrand && idsBrand.length) ? idsBrand.join('_') : 0;
                //console.log(brands);
                var uri = laroute.route('product.category',{slug:"{!!$category->slug!!}",range:rangePrice, colors: colors, 'brands':brands});              
                window.location.href = laroute.url(uri,[]);
            });
        });
    </script>
@endsection