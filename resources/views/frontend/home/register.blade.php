@extends('layouts.frontend')

@section('page-content')
<div class="columns-container">
    <div class="container" id="columns">
        <!-- breadcrumb -->
        <div class="breadcrumb clearfix">
            <a class="home" href="/" title="Trang chủ">Trang chủ</a>
            <span class="navigation-pipe">&nbsp;</span>
            <span class="navigation_page">ĐĂNG KÝ MỞ GIAN HÀNG TRÊN UMZILA</span>
        </div>
        <div class="row">
            <div class="center_column col-xs-12 col-sm-9" id="center_column">
                <h1 class="page-heading">
                    <span class="page-heading-title2">Đăng ký mở gian hàng trên Umzila</span>
                </h1>
                <article class="entry-detail checkout-page">
                    <div class="content-text clearfix">
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
                        {!! Form::open(['url' => route('home.register.post'), 'autocomplete'=>'off']) !!}
                        <h3 class="checkout-sep">Thông tin nhà cung cấp</h3>
                        <div class="box-border">
                            <ul>
                                <li class="row">
                                    <div class="col-sm-6">
                                        <label for="name" class="required">Tên nhà cung cấp <span class="text-danger">*</span></label>
                                        {!! Form::text('name',null, ['class' => 'input form-control']) !!}
                                    </div><!--/ [col] -->
                                    <div class="col-sm-6">
                                        <label for="phone" class="required">Số điện thoại <span class="text-danger">*</span></label>
                                        {!! Form::text('phone',null, ['class' => 'input form-control']) !!}
                                    </div><!--/ [col] -->
                                </li><!--/ .row -->
                                <li class="row">
                                    <div class="col-sm-6">
                                        <label for="store_show">Tên hiển thị/ Tên gian hàng <span class="text-danger">*</span></label>
                                        {!! Form::text('store_show',null, ['class' => 'input form-control']) !!}
                                    </div><!--/ [col] -->
                                    <div class="col-sm-6">
                                        <label for="email" class="required">Địa chỉ Email <span class="text-danger">*</span></label>
                                        {!! Form::email('email',null, ['class' => 'input form-control']) !!}

                                    </div><!--/ [col] -->
                                </li><!--/ .row -->
                            </ul>
                        </div>

                        <h3 class="checkout-sep">Thông tin kinh doanh</h3>
                        <div class="box-border">
                            <ul>
                                <li class="row">
                                    <div class="col-sm-6">
                                        <label for="company_name" class="required">Tên giấy phép/ Tên công ty trên giấy tờ <span class="text-danger">*</span></label>
                                        {!! Form::text('company_name',null, ['class' => 'input form-control']) !!}
                                    </div><!--/ [col] -->
                                    <div class="col-sm-6">
                                        <label for="company_type" class="required">Loại hình công ty <span class="text-danger">*</span></label>
                                         {!! Form::select('company_type', $companyType , null, ['class' => 'input form-control select-category']) !!}
                                    </div><!--/ [col] -->
                                </li><!--/ .row -->
                                <li class="row">
                                    <div class="col-sm-6">
                                        <label for="city">Thành phố/tỉnh</label>
                                        {!! Form::text('city',null, ['class' => 'input form-control']) !!}
                                    </div><!--/ [col] -->
                                    <div class="col-sm-6">
                                        <label for="district" class="required">Quận/Huyện</label>
                                        {!! Form::text('district',null, ['class' => 'input form-control']) !!}
                                    </div><!--/ [col] -->
                                </li><!--/ .row -->
                                <li class="row">
                                    <div class="col-sm-6">
                                        <label for="address">Địa chỉ</label>
                                        {!! Form::text('address',null, ['class' => 'form-control']) !!}
                                    </div><!--/ [col] -->
                                    <div class="col-sm-6">
                                        <label for="contact" class="required">Người liên hệ trực tiếp</label>
                                        {!! Form::text('contact',null, ['class' => 'input form-control']) !!}
                                    </div><!--/ [col] -->
                                </li><!--/ .row -->
                                <li class="row">
                                    <div class="col-sm-6">
                                        <label for="number_register">Số đăng ký kinh doanh</label>
                                        {!! Form::text('number_register',null, ['class' => 'input form-control']) !!}
                                    </div><!--/ [col] -->
                                </li><!--/ .row -->
                            </ul>
                        </div>

                        <h3 class="checkout-sep">Thông tin cửa hàng</h3>
                        <div class="box-border">
                            <ul>
                                <li class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="brand" class="required">Những nhãn hiệu bạn đang bán</label>
                                            {!! Form::text('brand',null, ['class' => 'input form-control']) !!}
                                        </div>
                                        <div class="form-group">
                                            <label for="note" class="required">Ghi chú</label>
                                            {!! Form::textarea('note',null, ['class' => 'input form-control','rows'=>'6','placeholder' => 'Lời nhắn']) !!}
                                        </div>
                                    </div><!--/ [col] -->
                                    <div class="col-sm-6">
                                        <label for="category_id" class="required">Ngành hàng chính <span class="text-danger">*</span></label>
                                        <ul>
                                            @foreach ($categories as $key => $value)
                                            <li><label>{!! Form::radio('category_id',$key ) !!}{{$value}}</label></li>
                                            @endforeach
                                            <li><label>Dịch vụ</label></li>
                                            @foreach ($services as $key => $value)
                                            <li><label>{!! Form::radio('category_id',$key ) !!}{{$value}}</label></li>
                                            @endforeach
                                        </ul>
                                    </div><!--/ [col] -->
                                </li><!--/ .row -->

                                <li>
                                    <button id="register-store" class="button">Đăng ký</button>
                                </li>
                            </ul>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </article>
            </div>
            <div class="column col-xs-12 col-sm-3" id="left_column">
                <!-- block category -->
                <div class="block left-module">
                    <p class="title_block">Danh mục</p>
                    <div class="block_content">
                        <!-- layered -->
                        <div class="layered layered-category">
                            <div class="layered-content">
                                <ul class="tree-menu">
                                    @foreach($categoryPost as $catePost)
                                    <li class="@if(count($catePost->children) > 0) active @endif ">
                                        <span></span><a href="{{route('post.category',$catePost->slug)}}">{{$catePost->name}}</a>
                                        @if (count($catePost->children) > 0)
                                        <ul>
                                            @foreach ($catePost->children as $children)
                                            <li><span></span><a href="{{route('post.category',$children->slug)}}">{{$children->name}}</a></li>
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
                <!-- ./block category  -->
            </div>
            <!-- ./right colunm -->
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
            // $('#register-store').click(function () {
            //     alert('Cám ơn bạn đã đăng ký vói chúng tôi. Chúng tôi sẽ liên hệ vói bạn sớm nhất có thể.');
            // })

        });
    </script>
@endsection