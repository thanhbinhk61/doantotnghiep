@extends('layouts.frontend')

@section('page-content')

@include('frontend._partials.quickview')
<div class="columns-container">
    <div class="container" id="columns">
        <div class="row">
            <div class="center_column col-xs-12 col-sm-3" id="left_column">
            @include('frontend.customer._left')
            </div>
            <div class="col-xs-12 col-sm-9">
                <div class="box-authentication">
                    @if (count($items))                        
                    <div id="orderList">
                        @foreach($items as $item)
                        <div class="orderItem">
                            <div class="row order-header compress">
                                <div class="col-xs-6 col-md-3 order-title">
                                    <span><a href="{{route('customer.order.show', $item->code)}}">Mã đơn hàng:# <b>{{$item->code}}</b></a></span>
                                    <span>Ngày lập: {{date('d/m/Y H:i', strtotime($item->created_at))}}</span>
                                </div>
                                <div class="col-xs-6 col-md-3 order-total">
                                    <span>Tổng tiền</span>
                                    <span><b>{{ number_format($item->total + $item->ship) }} ₫</b></span>
                                </div>
                                <div class="col-xs-6 col-md-3 order-payment">
                                    <span>Thanh toán</span>
                                    <span><b>Trả sau khi nhận hàng</b></span>
                                </div>
                                <div class="col-xs-6 col-md-2 order-status">
                                    <span>Tình trạng</span>
                                    <span><b>{{config("umzila.orderStatus.{$item->status}.name")}}</b></span>                                        
                                </div>
                                <div class="hidden-xs col-md-1 pull-right">
                                    <i class='fa {{ config("umzila.orderStatus.{$item->status}.fa")}} fa-2x'></i>                                      
                                </div>
                            </div>
                            <div class="order-body row" style="display: none;">
                                <div class="col-md-7 productList">      
                                    @foreach($item->products as $itemProduct)
                                    <div class="productItem">
                                        <div class="productImage"><img src="{{route('image.resize',[$itemProduct->image,75,100])}}"></div>
                                        <div class="productDetail">
                                            <span><a href="{{route('product.show', $itemProduct->slug)}}">{{$itemProduct->name}}</a></span>
                                            <span>Số lượng: {{$itemProduct->pivot->quantity}} </span>
                                            <span>Giá: {{number_format($itemProduct->pivot->price)}} ₫</span>
                                            <span class="orange"><b>{{config("umzila.orderStatus.{$item->status}.name")}}</b></span>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="col-md-5 orderAction">
                                    <div class="order-status">
                                        <span class="orange">
                                            <i class='fa {{config("umzila.orderStatus.{$item->status}.fa")}} fa-2x orange'></i>
                                            <i class="fa fa-money fa-2x"></i>
                                            <i class="fa fa-check fa-2x"></i>
                                        </span>
                                    </div>
                                    <div class="order-action">
                                        <span><a href="{{route('customer.order.show', $item->code)}}">Xem chi tiết</a></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach                         
                    </div>
                    <div class="sortPagiBar clearfix">
                        <div class="bottom-pagination">
                            <nav>
                              {{$items->render()}}
                            </nav>
                        </div>
                    </div>
                    @else
                    <p class="alert alert-warning"> Bạn chưa có đơn hàng nào cả</p>
                    @endif
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

            $('.order-header').click(function() {
                if($(this).next().css('display') == 'none') {
                    $(this).next().show(10);
                    $(this).removeClass('compress');
                    $(this).addClass('expand');
                }
                else {
                    $(this).next().hide();
                    $(this).removeClass('expand');
                    $(this).addClass('compress');
                }
            })
        });
    </script>
@endsection