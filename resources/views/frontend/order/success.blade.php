@extends('layouts.frontend')

@section('page-content')

<div class="columns-container">
    <div class="container" id="columns">
        <!-- breadcrumb -->
        <div class="breadcrumb clearfix">
            <a class="home" href="/" title="Trang chủ">Trang chủ</a>
            <span class="navigation-pipe">&nbsp;</span>
            <span class="navigation_page">Đơn hàng của bạn</span>
        </div>
        <!-- ./breadcrumb -->
        <!-- row -->
        <div class="row">
            <!-- Center colunm-->
            <div class="center_column col-xs-12 col-sm-9" id="center_column">
                <div class="box-authentication">
                    <div id="orderView">
                        <div class="block-title">
                            <h2>Chi tiết đơn hàng</h2>
                        </div>
                        <div class="block-content">
                            <div class="orderInfo">
                                <div class="order-head row">
                                    <div class="col-xs-12 col-sm-12 col-md-8">
                                    <span>Mã đơn hàng: <b>{{$order->code}}</b></span>
                                        <span>Ngày lập: {{date('d/m/Y H:i', strtotime($order->created_at))}}</span>
                                    </div>
                                </div>
                                <div class="customerInfo row">
                                    <div class="col-md-4">
                                        <p class="block-title">Địa chỉ nhận hàng</p>
                                        @if ($addressCustomer)
                                            <p>{{$addressCustomer->name}} </p>
                                            <p>{{$addressCustomer->phone}} </p>
                                            <p>{{$addressCustomer->address}}</p>
                                        @else
                                            <p>{{$order->name}} </p>
                                            <p>{{$order->phone}} </p>
                                            <p>{{$order->email}} </p>
                                            <p>{{$order->address}}</p>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <p class="block-title">Thông tin thanh toán</p>
                                        @if ($addressCustomer)
                                            <p>{{$me->name}} </p>
                                            <p>{{$me->email}} </p>
                                            <p>{{$me->phone}}</p>
                                            <p>{{$me->address}}</p>
                                        @else
                                            <p>{{$order->name}} </p>
                                            <p>{{$order->phone}} </p>
                                            <p>{{$order->email}} </p>
                                            <p>{{$order->address}}</p>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <p class="block-title">Phương thức thanh toán</p>
                                        <p>Thanh toán khi nhận hàng</p>
                                    </div>
                                </div>
                            </div>
                            <div class="orderProduct table-responsive">
                                <table class="table table-bordered" id='orderProduct'>
                                    <thead>
                                      <tr>
                                        <th style="width: 45%">Sản phẩm</th>
                                        <th class="text-right">Đơn giá</th>
                                        <th class="text-right">Số lượng</th>
                                        <th class="text-right">Tạm tính</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $product)
                                    <tr>                                                
                                        <td>
                                            <a href="{{route('product.show', $product->slug)}}" class="product-img hidden-xs hidden-sm">
                                                <img src="{{asset($product->image)}}">
                                            </a>
                                            <div class="product-detail">
                                                <a href="{{route('product.show', $product->slug)}}">{{$product->name}}</a>
                                                <p>{{$product->pivot->color}} 
                                                    @if($product->pivot->other != 0) +
                                                           <?php
                                                                $properties = [];
                                                                $ids = explode(',',$product->pivot->other);
                                                                if(count($ids)) {
                                                                    foreach ($ids as $key) {
                                                                        $properties[] = $product->others->keyBy('id')[$key]['name'];
                                                                    }
                                                                } else {
                                                                    $properties[] = $product->others->keyBy('id')[$ids]['name'];
                                                                }
                                                                echo implode(', ', $properties);
                                                            ?>
                                                        @endif
                                                 </p>
                                            </div>
                                        </td>
                                        <td class="text-right">{{ number_format($product->pivot->price)}} ₫</td>
                                        <td class="text-right">{{ number_format($product->pivot->quantity)}}</td>
                                        <td class="text-right">{{ number_format($product->pivot->price * $product->pivot->quantity)}} ₫</td>
                                    </tr>
                                    @endforeach
                                    <tr class="order-sum">
                                        <td class="text-left" colspan="2">Tạm tính</td>
                                        <td class="text-right" colspan="2">
                                        {{ number_format($products->sum(function ($item) {
                                            return $item->pivot->price * $item->pivot->quantity;
                                        })) }} ₫
                                    </td>
                                    </tr>
                                    @if($order->coupon_id)
                                    <tr class="order-sum">
                                        <td class="text-left" colspan="2">Giảm giá</td>
                                        <td class="text-right" colspan="2">-{{ number_format($order->coupon->value)}} {{$order->coupon->type == 1 ? '%' : '₫'}}</td>
                                    </tr>
                                    <tr class="order-sum">
                                        <td class="text-left" colspan="2">Thành tiền</td>
                                        <td class="text-right" colspan="2">{{ number_format($order->total)}} ₫</td>
                                    </tr>
                                    @endif
                                    <tr class="order-sum">
                                        <td class="text-left" colspan="2">Phí vận chuyển</td>
                                        <td class="text-right" colspan="2">{{ number_format($order->ship) }} ₫</td>
                                    </tr>
                                    <tr class="order-sum">
                                        <td class="text-left" colspan="2">Thanh toán</td>
                                        <td class="text-right" colspan="2">{{number_format($order->total + $order->ship)}} ₫</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
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
                                @foreach($categoryRoots as $cateRoot)
                                <li class="@if(count($cateRoot->children) > 0) active @endif ">
                                    <span></span><a href="{{route('product.category',$cateRoot->slug)}}">{{$cateRoot->name}}</a>
                                    @if (count($cateRoot->children) > 0)
                                    <ul>
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
            @include('frontend._partials.random')
            @include('frontend._partials.sale')
        </div>
        <!-- ./right colunm -->
    </div>
    <!-- ./row-->
</div>
</div>
@stop

@section('body-append')
@parent
{{ HTML::script('assets/backend/js/laroute.js') }}
<script>
    var totalOrder = parseCurrency({{Cart::total()}});
    $(function (){
        $('body').removeClass('home');
        $('.columns-container').css("background","#fff");
    });
</script>
@endsection