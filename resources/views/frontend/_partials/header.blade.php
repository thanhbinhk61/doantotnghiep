    <div id="header" class="header">
    <!--/.top-header -->
    <div class="container main-header">
        <div class="row top-main-header hidden-xs hidden-sm">
            <div class="col-sm-12 col-md-3"></div>
            <div class="col-sm-7 col-md-6">
                <ul class="main-header-top-link">
                @foreach($categoryPost->take(5) as $catePost)
                    <li><a href="{{route('post.category',$catePost->slug)}}">{{$catePost->name}}</a></li>
                @endforeach
                    @if(!empty($me))
                    <li><a href="{{route('customer.index')}}">Hi, {{$me->name}}</a></li>
                    @endif
                    <li><a href="#">Hỗ trợ: {{$configs->phone}}</a></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-3 logo">
                <a href="/"><img alt="" src="{{asset($configs->logo)}}" /></a>
            </div>
            <div class="col-xs-12 col-sm-8 col-md-7 header-search-box">
                {!! Form::open(['class' => 'form-inline','url' => route('product.search'),'method' => 'GET','autocomplete'=>'off']) !!}
                      <div class="form-group form-category">
                        {!! Form::select('category', $categoryList , null, ['class' => 'form-control select-category']) !!}
                      </div>
                      <div class="form-group input-serach" id="toolbar-search">
                        <input type="text" name="search"  placeholder="Tìm kiếm sản phẩm">
                      </div>
                      <button type="submit" class="pull-right btn-search"></button>
                {!! Form::close() !!}
            </div>
            <div class="col-xs-12 col-md-2 group-button-header">
                <div class="dropdown login-dropdown">
                    <a class="current-open btn-compare" data-toggle="dropdown" href="#">{{ empty($me) ? 'Đăng nhập' : str_limit($me->name,8) }}</a>
                    @if (empty($me))
                    <ul class="dropdown-menu mega_dropdown" role="menu">
                        <li><a href="{{route('auth.login')}}">Đăng nhập</a></li>
                        <li><a href="{{route('auth.register')}}">Đăng ký</a></li>
                        <li><a href="{{route('order.ship')}}">Order hàng ship</a></li>
                        {{--
                        <li><a href="#find-order" data-toggle="modal">Tra cứu đơn hàng</a></li>
                        --}}
                    </ul>
                    @else
                    <ul class="dropdown-menu mega_dropdown" role="menu">
                        <li><a href="{{route('customer.index')}}">Quản lý tài khoản</a></li>
                        <li><a href="{{route('customer.order')}}">Đơn hàng của tôi</a></li>
                        <li><a href="{{route('customer.wishlist')}}">Danh sách yêu thích</a></li>
                        <li><a href="{{route('order.ship')}}">Order hàng ship</a></li>
                        @if ($me->provider_id)
                            <li><a href="{{route('customer.provider.statistic')}}" >Thống kê sản phẩm</a></li>
                        @endif
                        {{--
                        <li><a href="#find-order" data-toggle="modal">Tra cứu đơn hàng</a></li>
                        --}}
                        <li><a href="{{route('auth.logout')}}">Đăng xuất</a></li>
                    </ul>
                    @endif
                    {{--
                        @include('frontend._partials._find_order')
                    --}}
                </div>
                <a title="Giỏ hàng của tôi" href="{{route('product.cart')}}" class="btn-cart" id="cart-block">
                    <span>Giỏ</span>
                    <span class="notify notify-right">{{Cart::count()}}</span>
                    <div class="cart-block">
                        <div class="cart-block-content">
                            @if(Cart::count())
                            <h5 class="cart-title">{{Cart::count()}} sản phẩm trong giỏ hàng</h5>
                            <div class="cart-block-list">
                                <ul>

                                @foreach(Cart::content() as $cart)
                                    <li class="product-info">
                                        <div class="p-left">
                                            <a onclick="return confirm('Are you sure you want to delete this item?');" href="{{route('product.cart.delete',$cart->rowid)}}" class="remove_link"></a>
                                            <a href="{{route('product.cart')}}">
                                            <img class="img-responsive" src="{{route('image.resize',[$cart->options->image,100,100])}}" alt="{{$cart->name}}">
                                            </a>
                                        </div>
                                        <div class="p-right">
                                            <p class="p-name">{{$cart->name}}</p>
                                            <p class="p-rice">{{number_format($cart->subtotal)}}</p>
                                            <p>số lượng: {{$cart->qty}}</p>
                                        </div>
                                    </li>
                                @endforeach
                                </ul>
                            </div>
                            <div class="toal-cart">
                                <span>Tổng</span>
                                <span class="toal-price pull-right">{{number_format(Cart::total())}}</span>
                            </div>
                            <div class="cart-buttons">
                                <a href="{{route('product.cart')}}" class="btn-check-out">Đặt mua</a>
                            </div>
                            @else
                                <h5 class="cart-title">Bạn chưa có sản phẩm nào trong giỏ hàng</h5>
                            @endif
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- END MANIN HEADER -->
    <div id="nav-top-menu" class="nav-top-menu">
        <div class="container">
            <div class="row">
                <div class="col-md-3" id="box-vertical-megamenus">
                    <div class="box-vertical-megamenus">
                        <h4 class="title">
                            <span class="btn-open-mobile home-page"><i class="fa fa-bars"></i></span>
                            <span class="title-menu">Danh mục</span>
                        </h4>
                        <div class="vertical-menu-content is-home">
                            <ul class="vertical-menu-list">
                            <?php $countMenu = 0;?>
                            @foreach ($menuLeft as $mleft)
                                <?php
                                    $countMenu ++;
                                    switch ($mleft->type) {
                                    case 'pages':
                                        $url = route('page.show',isset($mleft->page->slug)? $mleft->page->slug : '');
                                        break;
                                    case 'category-product':
                                        $url = route('product.category',isset($mleft->category->slug)? $mleft->category->slug : '');
                                        break;
                                    case 'category-post':
                                        $url = route('post.category',isset($mleft->category->slug)? $mleft->category->slug : '');
                                        break;
                                    case 'link':
                                        $url = $mleft->link;
                                        break;
                                  }
                                ?>
                                <li @if ($countMenu > 11) class="cat-link-orther" @endif>
                                    <a class="@if(count($mleft->children)) parent @endif" href="{{$url}}"><img class="icon-menu" alt="{{$mleft->name}}" src="{{$mleft->image ? route('image.resize',[$mleft->image,20,20]) : asset('assets/frontend/data/12.png')}}"></img> {{$mleft->name}}</a>
                                    @if (count($mleft->children))
                                    <div class="vertical-dropdown-menu">
                                        <div class="vertical-groups col-sm-12">
                                            @foreach ($mleft->children->take(3) as $mleft2)
                                            <?php
                                                switch ($mleft2->type) {
                                                case 'pages':
                                                    $url2 = route('page.show',isset($mleft2->page->slug)? $mleft2->page->slug : '');
                                                    break;
                                                case 'category-product':
                                                    $url2 = route('product.category',isset($mleft2->category->slug)? $mleft2->category->slug : '');
                                                    break;
                                                case 'category-post':
                                                    $url2 = route('post.category',isset($mleft2->category->slug)? $mleft2->category->slug : '');
                                                    break;
                                                case 'link':
                                                    $url2 = $mleft2->link;
                                                    break;
                                              }
                                            ?>
                                            <div class="mega-group col-sm-4">
                                                <h4 class="mega-group-header"><a href="{{$url2}}">{{$mleft2->name}}</a></h4>
                                                @if (count($mleft2->children))
                                                <ul class="group-link-default">
                                                    @foreach($mleft2->children as $mleft3)
                                                    <?php
                                                        switch ($mleft3->type) {
                                                        case 'pages':
                                                            $url3 = route('page.show',isset($mleft3->page->slug)? $mleft3->page->slug : '');
                                                            break;
                                                        case 'category-product':
                                                            $url3 = route('product.category',isset($mleft3->category->slug)? $mleft3->category->slug : '');
                                                            break;
                                                        case 'category-post':
                                                            $url3 = route('post.category',isset($mleft3->category->slug)? $mleft3->category->slug : '');
                                                            break;
                                                        case 'link':
                                                            $url3 = $mleft3->link;
                                                            break;
                                                      }
                                                    ?>
                                                    <li><a href="{{$url3}}">{{$mleft3->name}}</a></li>
                                                    @endforeach
                                                </ul>
                                                @endif
                                            </div>
                                            @endforeach
        
                                        </div>
                                    </div>
                                    @endif
                                </li>
                                @endforeach
                            </ul>
                            <div class="all-category"><span class="open-cate">Sản phẩm khác</span></div>
                        </div>
                    </div>
                </div>
                <div id="main-menu" class="col-md-9 main-menu hidden-xs hidden-sm">
                    <nav class="navbar navbar-default">
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                    <i class="fa fa-bars"></i>
                                </button>
                                <a class="navbar-brand" href="#">MENU</a>
                            </div>
                            <div id="navbar" class="navbar-collapse collapse">
                                <ul class="nav navbar-nav">
                                    <li class="active">
                                        <a href="/">Trang chủ</a>
                                    </li>
                                    @foreach($menuHead as $mhead)
                                        <?php
                                            switch ($mhead->type) {
                                            case 'pages':
                                                $url = route('page.show',isset($mhead->page->slug)? $mhead->page->slug : '');
                                                break;
                                            case 'category-product':
                                                $url = route('product.category',isset($mhead->category->slug)? $mhead->category->slug : '');
                                                break;
                                            case 'category-post':
                                                $url = route('post.category',isset($mhead->category->slug)? $mhead->category->slug : '');
                                                break;
                                            case 'link':
                                                $url = $mhead->link;
                                                break;
                                            }
                                        ?>
                                        <li class="@if (count($mhead->children)) dropdown @endif" >
                                            <a @if (count($mhead->children)) class="dropdown-toggle" data-toggle="dropdown" @endif href="{{$url}}">{{$mhead->name}}</a>
                                            @if (count($mhead->children))
                                                <ul class="dropdown-menu container-fluid" role="menu">
                                                    <li class="block-container">
                                                        <ul class="block">
                                                        @foreach ($mhead->children as $mhead2)
                                                        <?php
                                                            switch ($mhead2->type) {
                                                            case 'pages':
                                                                $url2 = route('page.show',isset($mhead2->page->slug)? $mhead2->page->slug : '');
                                                                break;
                                                            case 'category-product':
                                                                $url2 = route('product.category',isset($mhead2->category->slug)? $mhead2->category->slug : '');
                                                                break;
                                                            case 'category-post':
                                                                $url2 = route('post.category',isset($mhead2->category->slug)? $mhead2->category->slug : '');
                                                                break;
                                                            case 'link':
                                                                $url2 = $mhead2->link;
                                                                break;
                                                            }
                                                        ?>
                                                            <li class="link_container"><a href="{{$url2}}">{{$mhead2->name}}</a></li>
                                                        @endforeach
                                                        </ul>
                                                    </li>
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div><!--/.nav-collapse -->
                        </div>
                    </nav>
                </div>
                <div id="form-search-opntop">
                </div>
                <!-- CART ICON ON MMENU -->
                <div id="shopping-cart-box-ontop">
                    <i class="fa fa-shopping-cart"></i>
                    <div class="shopping-cart-box-ontop-content"></div>
                </div>
            </div>
        </div>
    </div>
</div>