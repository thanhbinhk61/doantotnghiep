@extends('layouts.frontend')

@section('page-content')
<div class="columns-container">
    <div class="container" id="columns">
        <!-- breadcrumb -->
        <div class="breadcrumb clearfix">
            <a class="home" href="/" title="Trang chủ">Trang chủ</a>
            <span class="navigation-pipe">&nbsp;</span>
            <span class="navigation_page">Thông tin chi tiết</span>
        </div>
        <!-- ./breadcrumb -->
        <!-- row -->
        <div class="row">
            <!-- Center colunm-->
            <div class="center_column col-xs-12 col-sm-9 page-order" id="center_column">
                <ul class="step">
                    <li class="current-step"><span> <i class="fa fa-check text-success"></i> 01. Giỏ hàng</span></li>
                    <li class="current-step" ><span> <i class="fa fa-check text-success"></i> 02. Đăng nhập</span></li>
                    <li class="current-step"><span> <i class="fa fa-check text-success"></i> 03. Thông tin</span></li>
                    <li class="current-step"><span> <i class="fa fa-check text-success"></i> 04. Thanh toán</span></li>
                </ul>
                <div class="box-authentication">
                    <div class="col-md-12">
                        <div class=""> <!-- box-border -->
                            <div class="box-heading">
                                <span>THÔNG TIN ĐƠN HÀNG</span>
                            </div>
                            <div class="box-content ">
                                <div class="orderInfo" id="orderPayment">
                                    <div class="customerInfo row">
                                        <div class="col-md-5">
                                        @if (isset($order))
                                            <p class="block-title">Địa chỉ nhận hàng</p>
                                            <p><i class="fa fa-check-circle text-primary"></i> Người nhận: <b>{{$order->name}}</b></p>
                                            <p><i class="fa fa-check-circle text-primary"></i> Điện thoại: {{$order->phone}}</p>
                                            <p><i class="fa fa-check-circle text-primary"></i> Email: {{$order->email}}</p>
                                            <p><i class="fa fa-check-circle text-primary"></i> Đ.Chỉ: {{$order->address}}</p>
                                            <p><i class="fa fa-check-circle text-primary"></i> Tỉnh thành: {{$order->expense->name}}</p>
                                            <p><i class="fa fa-check-circle text-primary"></i> Mã giảm giá: {{isset($code) ? 'Có': 'Không' }}</p>
                                            <p><i class="fa fa-check-circle text-primary"></i> Ghi chú: {{$order->note}}</p>
                                        @else 
                                            <p class="block-title">Địa chỉ nhận hàng</p>
                                            <p><i class="fa fa-check-circle text-primary"></i> Người nhận: <b>{{$addressCustomer->name}}</b></p>
                                            <p><i class="fa fa-check-circle text-primary"></i> Điện thoại: {{$addressCustomer->phone}}</p>
                                            <p><i class="fa fa-check-circle text-primary"></i> Email: {{$me->email}}</p>
                                            <p><i class="fa fa-check-circle text-primary"></i> Đ.Chỉ: {{$addressCustomer->address}}</p>
                                            <p><i class="fa fa-check-circle text-primary"></i> Tỉnh thành: {{$addressCustomer->expense->name}}</p>
                                            <p><i class="fa fa-check-circle text-primary"></i> Mã giảm giá: {{isset($code) ? 'Có': 'Không' }}</p>
                                            <p><i class="fa fa-check-circle text-primary"></i> Ghi chú: {{$addressCustomer->description}}</p>
                                        @endif
                                        </div>

                                        <div class="col-md-7">
                                            <p class="block-title"> Phương thức thanh toán</p>
                                            <p><i class="fa fa-hand-o-right"></i> Thanh toán khi nhận hàng</p>
                                            <p><i class="fa fa-hand-o-right"></i> Lưu ý</p>
                                            <p class="m-l-20">- Quý khách kiểm tra kỹ thông tin đơn hàng về địa chỉ giao hàng, sản phẩm & số lượng, giá trị thành tiền.</p>
                                            <p class="m-l-20">- Thông tin này sẽ không thể thay đổi sau khi đơn hàng được xác nhận thành công.</p>
                                            <p class="m-l-20">- Nếu quý khách có nhu cầu xuất hóa đơn, vui lòng liên hệ hotline 04.6673.1999 để gửi thông tin trong vòng 24 giờ kể từ khi đặt hàng thành công.</p>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <table class="table info-cart">
                                    <thead>
                                        <tr>
                                            <th width="50%" >Sản phẩm</th>
                                            <th class="text-right" >Số lượng</th>
                                            <th class="text-right">Thành tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach(Cart::content() as $cart)
                                        <tr>
                                            <td class="cart_description">
                                                <p class="product-name">
                                                    {{$cart->name}} 
                                                        @if ($cart->options->others) + {{$cart->options->others}} @endif
                                                        @if ($cart->options->color) + {{$cart->options->color}} @endif
                                                        @if ($cart->options->brand_name) + {{$cart->options->brand_name}} @endif
                                                </p>
                                            </td>
                                            <td class="qty text-right">
                                                <p>{{$cart->qty}}</p>
                                            </td>
                                            <td class="price text-right">
                                                <span >{{number_format($cart->subtotal)}} ₫</span>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2"><strong>Tạm tính</strong></td>
                                            <td class="text-right"><strong >{{number_format(Cart::total())}} ₫</strong></td>
                                        </tr>
                                    </tfoot>   
                                </table>
                            </div>
                            {!! Form::open(['url' => route('order.payment.store'),'autocomplete'=>'off']) !!}
                                @if (isset($code))
                                {!! Form::hidden('code',$code)!!}
                                @endif
                                @if (isset($addressCustomer))
                                {!! Form::hidden('address_id',$addressCustomer->id)!!}
                                @endif
                                <button type="submit" class="button"><i class="fa fa-lock"></i>  Đặt mua hàng</button>
                                
                                <p class="m-t-10">Bằng việc ấn nút Đặt mua hàng trên, </p>
                                <p> Quý khách xác nhận đã kiểm tra kỹ đơn hàng 
và đồng ý với Điều khoản            & điều kiện giao dịch của Umzila</p>
                            {!!Form::close()!!}
                        </div>
                    </div>
                </div>
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
        $(function (){
            $('body').removeClass('home');
            $('.columns-container').css("background","#fff");

        });
    </script>
@endsection