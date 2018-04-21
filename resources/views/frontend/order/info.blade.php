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
                    <li class="current-step"><span> <i class="fa fa-check text-success"></i> 03. Thanh toán</span></li>
                </ul>
                <div class="box-authentication">
                    <div class="col-sm-5">
                        <div class="box-border">
                            <div class="box-heading">
                                <span>Thông tin giao hàng</span>
                                @if (isset($order))
                                <a title="Cập nhật thông tin" class="pull-right" data-toggle="modal" href="#edit-guest"> <i class="fa  fa-pencil-square-o"></i></a>
                                @endif
                            </div>
                            <div class="box-content">
                                @if (isset($order))
                                    <b>Tên: {{$order->name}}</b>
                                    <p class="info">Email: {{$order->email}}</p>
                                    <p class="info">Điện thoại: {{$order->phone}}</p>
                                    <p class="info">Địa chỉ: {{$order->address}}</p>
                                    <p class="info">Ghi chú: {{$order->note}}</p>
                                @elseif ($me)
                                    <b>Tên: {{$me->name}}</b>
                                    <p class="info">Email: {{$me->email}}</p>
                                    <p class="info">Điện thoại: {{$me->phone}}</p>
                                    <p class="info">Địa chỉ: {{$me->address}}</p>

                                    <hr>
                                    <h4>Chọn địa chỉ giao hàng</h4>
                                    <ul>
                                        @if (count($me->addresses))
                                            <?php $count = 0; ?>
                                            @foreach($me->addresses as $address)
                                                <li>
                                                    <label><input type="radio" @if ($count++ == 0) checked=""  @endif name="address_id" value="{{$address->id}}">{{$address->name}}</label>
                                                    <a class="pull-right text-primary m-t-10" href="#address_info" data-toggle="modal" data-id ="{{$address->id}}"> <i class="fa fa-external-link"></i></a>
                                                </li>
                                            @endforeach
                                        @endif
                                        <br>
                                        <a href="#address-customer" data-toggle="modal" class="btn btn-primary btn-xs"> <i class="fa fa-plus"></i> Thêm địa chỉ mới</a>
                                    </ul>
                                @endif
                                <hr>
                                <div class="input-group add-on">
                                    <input type="text" class="form-control" placeholder="Mã giảm giá" name="coupon">
                                    <div class="input-group-btn">
                                        <a class="btn btn-default coupon-action no-borderRadius" href="#"><i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <p id="success-coupon" class="hide"> <i class="fa fa-check-circle text-primary"></i> <span class="text-primary"></span></p>
                                <p id="error-coupon" class="hide"> <i class="fa fa-check-circle text-danger"></i> <span class="text-danger"></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="box-border">
                            <div class="box-heading">
                                <span>Thông tin đơn hàng</span>
                            </div>
                            <div class="box-content table-responsive">
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
                        </div>
                        <br>
                        <div class="box-border">
                            <div class="box-heading">
                                <span>Phương thức thanh toán</span>
                            </div>
                            <div class="box-content">
                                <ul>
                                    <li><label class="radio-inline">{{ Form::radio('select-card',1, true ) }}  Thanh toán khi nhận hàng</label></li>
                                    <li><label class="radio-inline">{{ Form::radio('select-card',2 ) }}  Thanh toán qua thẻ ATM</label></li>
                                </ul>
                                <div id="card-atm" class="col-sm-12" style="display:none">
                                    <h4>lựa chọn thẻ ATM</h4>
                                    @if (!empty($me) && count($me->cards))
                                    <ul>
                                        @foreach ($me->cards as $card)
                                        <li><label class="radio-inline">{{ Form::radio('card',$card->id, true ) }}  {{$card->number}}</label></li>
                                        @endforeach
                                    </ul>
                                    @endif
                                    <br>
                                    {!! $configs->card_atm !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="box-border">
                    <a id="check_coupon" href="#" class="btn btn-primary no-borderRadius"><i class="fa fa-hand-o-right"></i> Gửi đơn hàng</a>
                </div>
                @if (isset($order))
                    @include('frontend.order._edit',['item' => $order])
                @else
                    @include('frontend.customer._address-create')
                    @include('frontend.order._address')
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
@include('frontend._partials.load')
@stop

@section('body-append')
    @parent
    {{ HTML::script('assets/backend/js/laroute.js') }}
    <script>
        var para = {a:null, c:null,card:null};
        function handlePara(obj) {
            var newObj = {};
            $.each(obj, function (k,v) {
                if (v !== null && v !== '') {
                    newObj[k] = v;
                }
            });
            return newObj;
        }

        $(function (){
            $('body').removeClass('home');
            $('.columns-container').css("background","#fff");

            $('input:radio[name="select-card"]').on('change', function () {
                if ($(this).val() == 2) {
                    $('#card-atm').show();
                    para.card = $('input:radio[name="card"]:checked').val();
                    $('input:radio[name="card"]').change( function () {
                        para.card = $(this).val();
                    });
                } else {
                    $('#card-atm').hide();
                    para.card = null;
                }
            });

            $('.coupon-action').click(function (e) {
                e.preventDefault();
                var val = $('input[name="coupon"]').val();
                if (!val) {
                    $('#error-coupon').removeClass('hide');
                    $('#error-coupon').find('span').text('Mời bạn nhập mã giảm giá.!');
                    return;
                }
                $.post(laroute.route('order.ajax.coupon',{coupon:val}), function (results) {
                    if (results.e == 0) {
                        para.c = val;
                        $('#error-coupon').addClass('hide');
                        $('#success-coupon').removeClass('hide');
                        var type = (results.type == 1) ? ' % ' : ' ₫';
                        $('#success-coupon').find('span').text(results.message);
                        //$('#check_coupon').attr('href',laroute.route('order.payment',handlePara(para)));
                    } else {
                        para.c = null;
                        $('#success-coupon').addClass('hide');
                        $('#error-coupon').removeClass('hide');
                        $('#error-coupon').find('span').text(results.message);
                        //$('#check_coupon').attr('href',laroute.route('order.payment',handlePara(para)));
                    }
                });
            });

            if ($('input:radio[name="address_id"]').is(':checked')) {
                para.a = $('input:radio[name="address_id"]').val();
                //$('#check_coupon').attr('href',laroute.route('order.payment',handlePara(para)));
            }

            $('input:radio[name="address_id"]').change( function () {
                para.a = $(this).val();
                //$('#check_coupon').attr('href',laroute.route('order.payment',handlePara(para)));
            });

            $('#check_coupon').on('click', function (e) {
                e.preventDefault();
                $("#load-order").modal('show');
                $.post(laroute.route('order.payment.store',handlePara(para)), function (results) {
                    $("#load-order").modal('hide');
                    window.location.replace(results.route);
                });
            })
        });
    </script>
@endsection