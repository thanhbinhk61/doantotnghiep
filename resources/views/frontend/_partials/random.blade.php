<!-- block best sellers -->
<div class="block left-module">
    <p class="title_block">Sản phẩm ngẫu nhiên</p>
    <div class="block_content">
        <div class="owl-carousel owl-best-sell" data-loop="true" data-lazy-load="true" data-nav = "false" data-margin = "0" data-autoplayTimeout="1000" data-autoplay="true" data-autoplayHoverPause = "true" data-items="1">
            @foreach($productRandom->chunk(4) as $chunks)
            <ul class="products-block best-sell">
            	@foreach($chunks as $chunk)
                <li>
                    <div class="products-block-left">
                        <a href="{{route('product.show',$chunk->slug)}}">
                            <img class="owl-lazy" data-src="{{route('image.resize',[$chunk->image,100,100])}}" alt="{{$chunk->name}}">
                        </a>
                    </div>
                    <div class="products-block-right">
                        <p class="product-name">
                            <a href="{{route('product.show',$chunk->slug)}}">{{$chunk->name}}</a>
                        </p>
                        <p class="product-price">{{$chunk->sale == 1 ? number_format($chunk->price) : number_format($chunk->price_sale)}} ₫</p>
                        <p class="product-star">
                            @for ($star = 1; $star < 6; $star++)
                            <i class="{{(count($chunk->getRating) && $star <= $chunk->getRating->first()->rating )? 'fa fa-star' : 'fa fa-star-o' }} "></i>
                            @endfor
                        </p>
                    </div>
                </li>
                @endforeach
            </ul>
            @endforeach
        </div>
    </div>
</div>
<!-- ./block best sellers  -->