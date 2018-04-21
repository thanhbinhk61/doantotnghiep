@extends('layouts.frontend')

@section('title','Order hàng ship')

@section('page-content')
<div class="columns-container">
    <div class="container" id="columns">
        <div class="row">
            <div class="col-sm-9">
                <div class="box-authentication">
                    <div class="box-heading">
                        <span>Thông tin sản phẩm order</span>
                        <a id="add-order-ship" href="#" class="btn btn-primary btn-xs pull-right"> <i class="fa fa-plus"></i> Thêm link </a>
                    </div>
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
                    {!! Form::open(['url' => route('ship.post'), 'autocomplete'=>'off']) !!}
                        <div class="form-group" id="order-ship-info">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Link sản phẩm <span class="text-danger">*</span></label>
                                    {!! Form::text('link[]',null, ['class' => 'form-control','placeholder' => 'http://']) !!}
                                </div>

                                <div class="col-sm-6">
                                    <label>Mô tả <span class="text-danger">*</span></label>
                                    {!! Form::text('description[]',null, ['class' => 'form-control','placeholder' => 'Màu sắc, Kích cỡ, khối lượng ...']) !!}
                                </div>
                            </div>
                        </div>

                        @if (!$me)
                        <div class="form-group">
                            <label>Tên <span class="text-danger">*</span></label>
                            {!! Form::text('name',null, ['class' => 'form-control','placeholder' => 'Tên']) !!}
                        </div>

                        <div class="form-group">
                            <label>Email <span class="text-danger">*</span></label>
                            {!! Form::email('email',null, ['class' => 'form-control','required','placeholder' => 'Email']) !!}
                        </div>

                        <div class="form-group">
                            <label>Số điện thoại</label>
                            {!! Form::text('phone',null, ['class' => 'form-control','placeholder' => 'Số điện thoại']) !!}
                        </div>

                        <div class="form-group">
                            <label>Địa chỉ</label>
                            {!! Form::text('address',null, ['class' => 'form-control','placeholder' => 'Địa chỉ']) !!}
                        </div>
                        @endif

                        <div class="form-group">
                            <label>Lời nhắn</label>
                            {!! Form::textarea('note',null, ['class' => 'form-control','rows'=>'3','placeholder' => 'Lời nhắn']) !!}
                        </div>
                        <hr>
                        <button type="submit" class="button" id="validation-order-ship"><i class="fa fa-hand-o-right"></i> Gửi sản phẩm order</button>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="col-sm-3 column" id="left_column">
                @include('frontend._partials.sale')
                @include('frontend._partials.random')
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

            $('#add-order-ship').on('click', function (e) {
                e.preventDefault();
                $('#order-ship-info').append('<div class="row">\
                    <div class="col-sm-6">\
                        <label>Link sản phẩm <span class="text-danger">*</span></label>\
                        <input name="link[]" type="text" class="form-control">\
                    </div>\
                    <div class="col-sm-6">\
                        <label>Mô tả <span class="text-danger">*</span></label>\
                        <input name="description[]" type="text" class="form-control">\
                    </div>\
                </div>');
            })

        });
    </script>
@endsection