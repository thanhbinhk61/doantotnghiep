<!-- block best sellers -->
    <div class="block left-module">
        <p class="title_block">Hàng giảm giá</p>
        <div class="block_content product-onsale">
            <ul class="product-list owl-carousel" data-loop="true" data-lazy-load="true" data-nav = "false" data-margin = "0" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-items="1" data-autoplay="true">
                @foreach($productSaleRandom as $sale)
                <li>
                    <div class="product-container">
                        <div class="left-block">
                            <a href="{{route('product.show',$sale->slug)}}">
                                <img class="img-responsive owl-lazy" alt="product" data-src="{{route('image.resize',[$sale->image,260,260])}}" />
                            </a>
                            <div class="price-percent-reduction2">{{100-round(($sale->price_sale/$sale->price)*100)}}%</div>
                        </div>
                        <div class="right-block">
                            <h5 class="product-name"><a href="{{route('product.show',$sale->slug)}}">{{$sale->name}}</a></h5>
                            <div class="product-star">
                                @for ($star = 1; $star < 6; $star++)
                                <i class="{{(count($sale->getRating) && $star <= $sale->getRating->first()->rating )? 'fa fa-star' : 'fa fa-star-o' }} "></i>
                                @endfor
                            </div>
                            <div class="content_price">
                                <span class="price product-price">{{number_format($sale->price_sale)}} ₫</span>
                                <span class="price old-price">{{number_format($sale->price)}} ₫</span>
                            </div>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    <!-- ./block best sellers  -->