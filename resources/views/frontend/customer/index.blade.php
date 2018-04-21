@extends('layouts.frontend')

@section('head-append')
    @parent
{{ HTML::style('assets/backend/css/plugins/sweetalert/sweetalert.css')}}
@endsection

@section('page-content')
<div class="columns-container">
    <div class="container" id="columns">
        <div class="row">
            <div class="center_column col-xs-12 col-sm-3" id="left_column">
            @include('frontend.customer._left')
            </div>
            <div class="col-sm-9">
                <div class="box-authentication">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="box-border">
                                <div class="box-heading">
                                    <span>Thông tin tài khoản</span>
                                    <a title="Cập nhật thông tin" class="pull-right action-toggle" href="#"> <i class="fa  fa-pencil-square-o"></i></a>
                                </div>
                                <div class="box-content">
                                    <p class="info">{{$item->name}}</p>
                                    <p class="info">{{$item->email}}</p>
                                </div>
                            </div>
                            <br>
                            <div class="box-border">
                                <div class="box-heading">
                                    <span>Sổ địa chỉ giao hàng</span>
                                    <a href="#address-customer" data-toggle="modal" class="btn btn-primary btn-xs pull-right"> <i class="fa fa-plus"></i> Thêm <span class="hidden-xs"> địa chỉ mới </span></a>
                                </div>
                                <div class="box-content">
                                    @if (count($item->addresses))
                                        @foreach($item->addresses as $address)
                                        <p class="info show-info"><i class="fa fa-check-circle text-primary" ></i><a href="#" data-id="{{$address->id}}" class="show-address"> {{$address->name}} </a>
                                            <a class="pull-right handle-delete" href="{{route('customer.address.destroy',$address->id)}}"> <i class="fa fa-times-circle text-danger"></i></a>
                                        </p>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <br>
                            <div class="box-border" id="detail-address" style="display:none">
                                <div class="box-heading">
                                    <span>Thông tin địa chỉ</span>
                                </div>
                                <div class="box-content">
                                    <p class="info"><i class="fa fa-check text-primary" ></i> <span class="address-name"></span></p>
                                    <p class="info"><i class="fa fa-check text-primary" ></i> <span class="address-phone"></span></p>
                                    <p class="info"><i class="fa fa-check text-primary" ></i> <span class="address-address"></span></p>
                                    <p class="info"><i class="fa fa-check text-primary" ></i> <span class="address-description"></span></p>
                                </div>
                            </div>

                        </div>

                        <div class="col-sm-6 update-info" style="display:none">
                            <div class="box-border">
                                <p class="box-heading">Cập nhật tài khoản</p>
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
                                    {!! Form::model($item, ['url' => route('customer.update'), 'autocomplete'=>'off']) !!}
                                        <label for="name">Tên</label>
                                        {!! Form::text('name',null, ['class' => 'form-control','required']) !!}

                                        <label for="email">Email</label>
                                        {!! Form::email('email',null, ['class' => 'form-control','required','disabled']) !!}

                                        <label for="gender">Giới tính: </label>
                                        <label class="radio-inline">{!! Form::radio('gender',1,true ) !!}  Nam</label>
                                        <label class="radio-inline">{!! Form::radio('gender',2 ) !!}  Nữ</label>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-8">
                                                    <label for="phone">Số điện thoại</label>
                                                    {!! Form::text('phone',null, ['class' => 'form-control']) !!}
                                                </div>

                                                <div class="col-sm-4">
                                                    <label for="age">Tuổi</label>
                                                    {!! Form::text('age',null, ['class' => 'form-control']) !!}
                                                </div>
                                            </div>
                                        </div>

                                        <label for="address">Địa chỉ</label>
                                        {!! Form::text('address',null, ['class' => 'form-control']) !!}

                                        <label for="address">Ghi chú</label>
                                        {!! Form::textarea('description',null, ['class' => 'form-control','rows'=>'3']) !!}
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label for="password">Mật khẩu</label>
                                                    {!! Form::password('password', ['class' => 'form-control']) !!}
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="password_confirmation">Nhập lại mật khẩu</label>
                                                    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <button class="button"><i class="fa fa-lock"></i> Cập nhật</button>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('frontend.customer._address-create')
@endsection

@section('body-append')
    @parent
    {{ HTML::script('assets/backend/js/plugins/sweetalert/sweetalert.min.js') }}
    <script>
        var addresses = '{!!$item->addresses!!}';
        $(function (){
            $('body').removeClass('home');
            $('.columns-container').css("background","#fff");

            $('.action-toggle').click(function (e) {
                e.preventDefault();
                $('.update-info').toggle('hide');
            });

            $('.show-address').click(function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                var data = JSON.parse(addresses);
                var result = $.grep(data, function (e, i) {
                                return e.id == id;
                            });
                
                if (result.length) {
                    if ($('#detail-address').is(':hidden')) {
                        $('span.address-name').text('Tên: ' + result[0].name);
                        $('span.address-phone').text('Điện thoại: ' + result[0].phone);
                        $('span.address-address').text('Địa chỉ: ' + result[0].address);
                        $('span.address-description').text('Chi tiết: ' + result[0].description);
                    }
                    $('#detail-address').toggle('hide');
                }
                
            });

            $('.handle-delete').click(function (e) {
                e.preventDefault();
                $this = $(this);
                swal({
                    title: "Bạn chắc chắn chứ?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Chắc chắn!",
                    cancelButtonText: "Hủy",
                    closeOnConfirm: false
                }, function() {
                    $.post($this.attr('href'), {_method: 'DELETE'}, function (data) {
                        window.location.reload();
                    });
                });
            });

        });
    </script>
@endsection