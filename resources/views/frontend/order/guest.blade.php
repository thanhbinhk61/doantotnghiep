@extends('layouts.frontend')

@section('page-content')

<div class="columns-container">
    <div class="container" id="columns">
        <!-- breadcrumb -->
        <div class="breadcrumb clearfix">
            <a class="home" href="/" title="Trang chủ">Trang chủ</a>
            <span class="navigation-pipe">&nbsp;</span>
            <span class="navigation_page">Đăng nhập hoặc đặt hàng không cần đăng ký</span>
        </div>
        <!-- ./breadcrumb -->
        <!-- row -->
        <div class="row">
            <!-- Center colunm-->
            <div class="center_column col-xs-12 col-sm-9 page-order" id="center_column">
                <ul class="step">
                    <li class="current-step"><span> <i class="fa fa-check text-success"></i> 01. Giỏ hàng</span></li>
                    <li class="current-step" ><span> <i class="fa fa-check text-success"></i> 02. Đăng nhập</span></li>
                    <li><span>03. Thanh toán</span></li>
                </ul>
                <div class="box-authentication">
                    <div class="col-sm-4">
                        <div class="box-border">
                            <div class="box-heading">
                                <h3>Đăng nhập?</h3>
                            </div>
                            <div class="box-content">
                                @if(count($errors) > 0)
                                <div class="alert alert-danger">
                                    <strong>Lỗi:</strong>
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{$error}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                                {!! Form::open(['url' => route('auth.login'), 'autocomplete'=>'off']) !!}
                                    <label for="email">Địa chỉ Email</label>
                                    {!! Form::email('email',null, ['class' => 'form-control','required']) !!}
                                    <label for="password">Mật khẩu</label>
                                    {!! Form::password('password', ['class' => 'form-control']) !!}
                                    <button class="button"><i class="fa fa-lock"></i> Đăng nhập</button>
                                {!! Form::close() !!}
                                <hr>
                                {{--
                                <div class="social-link">
                                    <span>Đăng nhập với:  </span>
                                    <a href="{{route('auth.social','facebook')}}"><i class="fa fa-facebook"></i></a>
                                    <a href="{{route('auth.social','google')}}"><i class="fa fa-google-plus"></i></a> 
                                </div>
                                --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="box-border">
                            <div class="box-heading">
                                <h3>Đăng nhập hoặc đặt hàng không cần đăng ký</h3>
                            </div>
                            <div class="box-content">
                                <ul class="shipping_method">
                                    <li>
                                        <p class="subcaption bold">Đăng nhập</p>
                                        <label><input type="radio" checked="" name="is_guest" value="1" > Tôi đã có tài khoản tại Umzila.vn</label>
                                    </li>
                                    <li>
                                        <p class="subcaption bold">Khách hàng thanh toán</p>
                                        <label><input type="radio" name="is_guest" value="2">Đặt hàng mà không cần đăng ký</label>
                                    </li>
                                </ul>
                                <hr>
                                <div class="guest-checkout hide">
                                    {!! Form::open(['url' => route('order.guest.checkout'),'autocomplete'=>'off']) !!}
                                    @if (count($errors) > 0)
                                        <div class="alert alert-danger">
                                            <strong>Xin lỗi!</strong> Bạn cần nhập chính xác thông tin yêu cầu.<br><br>
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="name" class="control-label">Họ và Tên: <span class="text-danger">(*)</span></label>
                                                {!! Form::text('name',null, ['class' => 'form-control', 'required','placeholder' => 'Họ & Tên']) !!}
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="email" class="control-label">Email:</label>
                                                {!! Form::email('email',null, ['class' => 'form-control', 'placeholder' => 'email@email.com']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="phone" class="required">Số điện thoại <span class="text-danger">(*)</span></label>
                                                {!! Form::text('phone',null, ['class' => 'form-control','placeholder' => '09...']) !!}
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="ship_id" class="required">Khu vực <span class="text-danger">(*)</span></label>
                                                {!! Form::select('ship_id', $shipList , null, ['class' => 'input form-control select-category change-price']) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Địa chỉ giao hàng <span class="text-danger">(*)</span></label>
                                        {!! Form::text('address',null, ['class' => 'form-control']) !!}
                                    </div>

                                    <div class="form-group">
                                        <label>Lời nhắn</label>
                                        {!! Form::textarea('note',null, ['class' => 'input form-control','rows'=>'3']) !!}
                                    </div>
                                    <button type="submit" class="button">Tiếp tục</button>
                                    {!!Form::close()!!}
                                    <h4>Thông tin giao hàng</h4>
                                    <p><i class="fa fa-check-circle text-primary"></i> <span id="regions-price"></span></p>
                                </div>
                            </div>
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
        var totalOrder = parseCurrency({{Cart::total()}});
        $(function (){
            $('body').removeClass('home');
            $('.columns-container').css("background","#fff");
            $('input:radio[name="is_guest"]').on('change', function () {
                ($(this).val() == '2') ? $('.guest-checkout').removeClass('hide') : $('.guest-checkout').addClass('hide');
            });

            $('.change-price').change(function() {
                var id = $(this).val();
                $.post(laroute.route('order.ajax.expense'), {id:id}, function (results) {
                    var priceChange = (results) ? parseCurrency(results.price) : 0;
                    $('.shipping-price').text(localeString(priceChange) + ' ₫');
                    $('.total-order').text(localeString(totalOrder + priceChange) + ' ₫');
                    $('#regions-price').text(' G.hàng tại ' + results.name + ' chi phí: ' + localeString(priceChange) + ' ₫');
                });
            });
        });
    </script>
@endsection