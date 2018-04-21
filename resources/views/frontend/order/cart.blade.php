@extends('layouts.frontend')

@section('page-content')

<div class="columns-container">
    <div class="container" id="columns">
        <!-- breadcrumb -->
        <div class="breadcrumb clearfix">
            <a class="home" href="/" title="Trang chủ">Trang chủ</a>
            <span class="navigation-pipe">&nbsp;</span>
            <span class="navigation_page">Giỏ hàng của bạn</span>
        </div>
        <!-- ./breadcrumb -->
        <!-- row -->
        <div class="row">
            <!-- Center colunm-->
            <div class="center_column col-xs-12 col-sm-9 page-order" id="center_column">
                <!-- Cart  -->
                @if (Cart::count())
                <ul class="step">
                    <li class="current-step"><span> <i class="fa fa-check text-success"></i> 01. Giỏ hàng</span></li>
                    <li><span>02. Đăng nhập</span></li>
                    <li><span>03. Thanh toán</span></li>
                </ul>
                <div class="box-authentication">
                    <table class="table table-responsive cart_summary">
                        <thead>
                            <tr>
                                <th class="cart_product">Hình ảnh</th>
                                <th class="hidden-xs">Mô tả</th>
                                <th class="text-right" >Đơn giá</th>
                                <th class="text-right" >Số lượng</th>
                                <th class="hidden-xs text-right">Thành tiền</th>
                                <th  class="action"><i class="fa fa-trash-o"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($carts as $cart)
                            <tr>
                                <td class="cart_product">
                                    <a href="{{route('product.show',$cart->options->slug)}}"><img src="{{route('image.resize',[$cart->options->image,100,100])}}" alt="{{$cart->name}}"></a>
                                </td>
                                <td class="cart_description hidden-xs">
                                    <p class="product-name"><a href="{{route('product.show',$cart->options->slug)}}">{{$cart->name}} </a></p>
                                    <small class="cart_ref">Mã : {{$cart->options->code}}</small><br>
                                    @if ($cart->options->provider_name)
                                    <small class="cart_ref">Nhà cung cấp: <a href="{{route('product.provider',$cart->options->provider_slug)}}">{{$cart->options->provider_name}}</a></small><br>
                                    @endif
                                    @if ($cart->options->color)
                                    <small><p>Màu sắc : {{$cart->options->color}}</p></small><br>
                                    @endif
                                    @if ($cart->options->brand_name)
                                    <small><a href="{{route('brand.product',$cart->options->brand_id)}}">Thương hiệu : {{$cart->options->brand_name}}</a></small><br>   
                                    @endif
                                    @if ($cart->options->others)
                                    <small><a href="#">Thuộc tính : {{$cart->options->others}}</a></small><br>  
                                    @endif
                                </td>
                                <td class="price"><span>{{number_format($cart->price)}} ₫</span></td>
                                <td class="qty">
                                    <input class="option-product-qty" type="number" data-id="{{$cart->rowid}}" data-max-qty="{{$cart->options->max_qty}}" name="quantity" value="{{$cart->qty}}">
                                </td>
                                <td class="price hidden-xs">
                                    <span id="{{$cart->rowid}}">{{number_format($cart->subtotal)}} ₫</span>
                                </td>
                                <td class="action">
                                    <a onclick="return confirm('Are you sure you want to delete this item?');" href="{{route('product.cart.delete',$cart->rowid)}}"></a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                        <tfoot>
                            <tr class="total-price">
                                <td colspan="4"><strong>Tổng chi phí</strong></td>
                                <td colspan="2"><strong class="cart-total total-order">{{number_format(Cart::total())}} ₫</strong></td>
                            </tr>

                            <tr>
                                <td colspan="6">
                                    <a href="javascript:window.history.back()" class="btn btn-default no-borderRadius"><i class="fa fa-arrow-left"></i> Tiếp tục mua hàng</a>
                                    <a href="{{route('order.guest')}}" class="btn btn-primary no-borderRadius"><i class="fa fa-hand-o-right"></i> Chọn phương thức thanh toán</a>
                                </td>
                            </tr>
                        </tfoot>    
                    </table>
                </div>
                @else
                <p class="alert alert-warning">Bạn chưa có sản phẩm trong giỏ hàng</p>
                @endif
            </div>
            <!-- ./ Center colunm -->
            <!-- Left colunm -->
            <div class="column col-xs-12 col-sm-3" id="left_column">
                @include('frontend.order._info')
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

            $(':input[name="quantity"]').change(function () {
                var rowId = $(this).data('id');
                var maxQty = $(this).data('max-qty');
                if ($(this).val() > maxQty) {
                    $(this).val(maxQty);
                }
                if ($(this).val() < 0) {
                    $(this).val(0);
                }
                $.post(laroute.route('product.cart.update'), {rowid:rowId,quantity:$(this).val()}, function (results) {
                    $('#' + rowId).text(localeString(results.subtotal) + ' ₫');
                    $('.quantity-checkout').text(results.quantity);
                    $('.total-checkout').text(localeString(results.total) + ' ₫');
                    $('.total-order').text(localeString(results.total) + ' ₫');
                    $('.code-coupon').remove();
                    totalOrder = results.total;
                    
                });
            });
        });
    </script>
@endsection