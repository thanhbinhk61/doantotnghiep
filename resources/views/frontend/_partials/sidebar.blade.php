<div class="col-md-3 sidebar-wrap">
    <div class="main-sidebar">
        {{--
        <div class="widget woocommerce widget_price_filter">
            <h4 class="widget-title"><span>Price</span></h4>
            <form>
                <div class="price_slider_wrapper">
                    <div class="price_slider"></div>
                    <div class="price_slider_amount">
                        <input type="text" id="min_price" name="min_price" value="" data-min="250000" placeholder="Min price"/>
                        <input type="text" id="max_price" name="max_price" value="" data-max="5000000" placeholder="Max price"/>
                        <button type="submit" class="button">Filter</button>
                        <div class="price_label">
                            Price: <span class="from"></span> &mdash; <span class="to"></span>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </form>
        </div>
        
        <div class="widget woocommerce widget_swatches">
            <h4 class="widget-title"><span>Màu sắc</span></h4>
            @if (isset($colors))
            <ul class="swatches-options clearfix">
                @foreach($colors as $color)
                <li>
                    <a title="Green (3)" href="#">
                        <i class="{{$color->value}}"></i>
                    </a>
                </li>
                @endforeach
            </ul>
            @endif
        </div>
        <div class="widget woocommerce widget_swatches">
            <h4 class="widget-title"><span>Kích cỡ</span></h4>
            @if (isset($sizes))
            <ul class="swatches-options clearfix">
                @foreach($sizes as $size)
                <li>
                    <a title="Extra Large (3)" width="32" height="32" href="#">{{$size->value}}</a>
                </li>
                @endforeach
            </ul>
            @endif
        </div>
        --}}
        <div class="widget woocommerce widget_product_categories">
            <h4 class="widget-title"><span>Danh mục</span></h4>
            @if(isset($categories))
            <ul class="product-categories">
                @foreach($categories as $category)
                <li><a href="{{route('product.category',$category->slug)}}">{{$category->name}}</a></li>
                @endforeach
            </ul>
            @endif
        </div>
        <div class="widget woocommerce widget_products">
            <h4 class="widget-title"><span>Sản phẩm ngẫu nhiên</span></h4>
            <ul class="product_list_widget">
                @foreach($productRandom as $random)
                <li>
                    <a href="{{route('product.show',$random->slug)}}" title="Donec tincidunt justo">
                        <img width="100" height="150" src="{{route('image.resize',[$random->image,100,150])}}" alt="Product-13"/>
                        <span class="product-title">{{$random->name}}</span>
                    </a>
                    @if($random->sale == 1)
                    <ins><span class="amount">{{number_format($random->price)}} ₫</span></ins>
                    @else
                    <del><span class="amount">{{number_format($random->price)}} ₫</span></del>
                    <ins><span class="amount">{{number_format($random->price_sale)}} ₫</span></ins>
                    @endif
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>