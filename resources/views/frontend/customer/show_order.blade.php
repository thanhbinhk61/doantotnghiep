@extends('layouts.frontend')

@section('page-content')
<div class="columns-container">
    <div class="container" id="columns">
        <div class="row">
            <div class="center_column col-xs-12 col-sm-3" id="left_column">
            @include('frontend.customer._left')
            </div>
            <div class="col-xs-12 col-sm-9">
                <div class="box-authentication">
                    <div id="orderView">
                        <div class="block-title">
                            <h2>Chi tiết đơn hàng</h2>
                        </div>
                        <div class="block-content">
                            <div class="orderInfo">
                                <div class="order-head row">
                                    <div class="col-xs-12 col-sm-12 col-md-8">
                                        <span>Mã đơn hàng: <b>{{$item->code}}</b></span>
                                        <span>Ngày lập: {{date('d/m/Y H:i', strtotime($item->created_at))}}</span>
                                    </div>
                                    <div class="col-md-4 order-print hidden-xs hidden-sm">
                                        <span><a href="{{route('customer.order.show', [$item->code,'print'])}}"  target="_blank" class="text-right">In hóa đơn <i class="fa fa-print"></i></a></span>
                                    </div>
                                </div>
                                <div class="customerInfo row">
                                    <div class="col-md-4">
                                        <p class="block-title">Địa chỉ nhận hàng</p>
                                        <p>{{$address->name}} </p>
                                        <p>{{$address->phone}} </p>
                                        <p>{{$address->address}}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <p class="block-title">Thông tin thanh toán</p>
                                        <p>{{$me->name}} </p>
                                        <p>{{$me->email}} </p>
                                        <p>{{$me->phone}}</p>
                                        <p>{{$me->address}}</p>
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
                                                    <img src="{{route('image.resize',[$product->image,75,100])}}">
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
                                        @if($item->coupon_id)
                                        <tr class="order-sum">
                                            <td class="text-left" colspan="2">Giảm giá</td>
                                            <td class="text-right" colspan="2">-{{ number_format($item->coupon->value)}} {{$item->coupon->type == 1 ? '%' : '₫'}}</td>
                                        </tr>
                                        <tr class="order-sum">
                                            <td class="text-left" colspan="2">Thành tiền</td>
                                            <td class="text-right" colspan="2">{{ number_format($item->total)}} ₫</td>
                                        </tr>
                                        @endif
                                        <tr class="order-sum">
                                            <td class="text-left" colspan="2">Phí vận chuyển</td>
                                            <td class="text-right" colspan="2">{{ number_format($item->ship) }} ₫</td>
                                        </tr>
                                        <tr class="order-sum">
                                            <td class="text-left" colspan="2">Thanh toán</td>
                                            <td class="text-right" colspan="2">{{number_format($item->total + $item->ship)}} ₫</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('body-append')
    @parent
    <script>
        $(function (){
            $('body').removeClass('home');
            $('.columns-container').css("background","#fff");         
        });
    </script>
@endsection