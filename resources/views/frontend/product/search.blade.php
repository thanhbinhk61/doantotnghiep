@extends('layouts.frontend')

@section('page-content')

@include('frontend._partials.quickview')

<div class="columns-container">
    <div class="container" id="columns">
        <!-- breadcrumb -->
        <div class="breadcrumb clearfix">
            <a class="home" href="/" title="Về trang chủ">Trang chủ</a>
            <span class="navigation-pipe">&nbsp;</span>
            <span class="navigation_page">Các sản phẩm liên quan đến: {{$value}}</span>
        </div>
        <!-- ./breadcrumb -->
        <!-- row -->
        <div class="row">
            <!-- Left colunm -->
            <div class="column col-xs-12 col-sm-3" id="left_column">                
                @include('frontend._partials.sale')
            </div>
            <!-- ./left colunm -->
            <!-- Center colunm-->
            <div class="center_column col-xs-12 col-sm-9" id="center_column">
                <!-- view-product-list-->
                <div id="view-product-list" class="view-product-list">
                    <h2 class="page-heading">
                        <span class="page-heading-title">" {{$value}} " |<span class="search-result"> Tìm thấy {{count($productSearch)}} sản phẩm</span></span> 
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
                        @foreach($productSearch as $product)
                        <div class="col-sx-12 col-sm-4">
                            <li class="product-container">
                                <div class="left-block">
                                    <a href="{{route('product.show',$product->slug)}}">
                                        <img class="img-responsive" alt="{{$product->name}}" src="{{route('image.resize',[$product->image,300,300])}}" />
                                    </a>
                                    <div class="quick-view">
                                            <a title="yêu thích" class="heart wish-list" href="{{ empty($me) ? route('auth.login') : route('customer.wishlist.add',$product->id) }}"></a>
                                            <a title="Xem nhanh" data-quickview="{{$product->id}}" href="#product-quickview" class="search click-quickview"></a>
                                    </div>
                                </div>
                                <div class="right-block">
                                    <h5 class="product-name"><a href="{{route('product.show',$product->slug)}}">{{mb_substr($product->name,0,25,'UTF-8')}}</a></h5>
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
                        
                        {!! str_replace('?', '?', $productSearch->render()) !!}
                        </nav>
                    </div>
                </div>
            </div>
            <!-- ./ Center colunm -->
        </div>
        <!-- ./row-->
    </div>
</div>
@include('frontend._partials.viewed')
@endsection

@section('body-append')
    @parent
    {!! HTML::script('assets/frontend/lib/jquery-ui/jquery-ui.min.js') !!}
    {{ HTML::script('assets/backend/js/laroute.js') }}
    <script type="text/javascript">
        $(function (){
            $('body').removeClass('home');
            $('.columns-container').css("background","#fff");
        });
    </script>
@endsection