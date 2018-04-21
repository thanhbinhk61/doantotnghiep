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
                        <div class="col-sm-12">
                            <div class="box-border">
                                <div class="box-heading">
                                    <span>Thông tin tài khoản thanh toán</span>
                                    <a href="#card-customer" data-toggle="modal" class="btn btn-primary btn-xs pull-right"> <i class="fa fa-plus"></i> Thêm </a>
                                </div>
                                <div class="box-content">
                                    @if (count($items))
                                        @foreach($items as $item)
                                        <p class="info show-info"><i class="fa fa-check-circle text-primary" ></i><a href="#" data-id="{{$item->id}}" class="show-address"> {{$item->number}} </a>
                                            <a class="pull-right handle-delete" href="{{route('customer.card.destroy',$item->id)}}"> <i class="fa fa-times-circle text-danger"></i></a>
                                        </p>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <br>
                            <div class="box-border" id="detail-address" style="display:none">
                                <div class="box-heading">
                                    <span>Thông tin chi tiết</span>
                                </div>
                                <div class="box-content">
                                    <p class="info"><i class="fa fa-check text-primary" ></i> <span class="address-name"></span></p>
                                    <p class="info"><i class="fa fa-check text-primary" ></i> <span class="address-phone"></span></p>
                                    <p class="info"><i class="fa fa-check text-primary" ></i> <span class="address-address"></span></p>
                                    <p class="info"><i class="fa fa-check text-primary" ></i> <span class="address-description"></span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('frontend.customer._card-create')
@endsection

@section('body-append')
    @parent
    {{ HTML::script('assets/backend/js/plugins/sweetalert/sweetalert.min.js') }}
    <script>
        $(function (){
            $('body').removeClass('home');
            $('.columns-container').css("background","#fff");

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