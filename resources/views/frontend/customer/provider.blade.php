@extends('layouts.frontend')

@section('head-append')
    @parent
{{ HTML::style('vendor/daterangepicker/daterangepicker-bs3.css')}}
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
                            <div class="form-group">
                                <div class="input-group">
                                <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right" id="datetime" value="{{ $dateRange}}">
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="btn-group" role="group" aria-label="...">
                                <a href="#" data-trigger="date-group" data-group="date" class="btn btn-default">Ngày</a>
                                <a href="#" data-trigger="date-group" data-group="month" class="btn btn-default">Tháng</a>
                                <a href="#" data-trigger="date-group" data-group="year" class="btn btn-default">Năm</a>
                            </div>
                            <div class="btn-group pull-right">
                                <a href="#" data-trigger="export" class="btn btn-primary">Xuất file</a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                    <!-- DEV  -->
                    @if (count($items))
                    <div class="col-md-12">
                        <table class="table table-hover" id="wish-list">
                            <thead>
                              <tr>
                                <th style="width: 45%">Sản phẩm</th>
                                <th class="hidden-xs">Đã bán</th>
                                <th >Còn lại</th>
                                <th >Giá</th>
                                <th class="hidden-xs">Chiết khấu</th>
                                <th>Thực nhận</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach($items as $item)
                                <?php 
                                    $dates = explode(' - ', $dateRange);
                                    $statisticCollect = $item->orderStatistic($dates[0], $dates[1], $dateGroup)->get();
                                ?>
                                @if (count($statisticCollect))
                                <tr>
                                    <td>
                                        <a href="{{route('product.show', $item->slug)}}" class="item-wl-img">
                                            <img src="{{route('image.resize',[$item->image,75,95])}}">
                                        </a>
                                        <div class="hidden-xs">
                                            <div class="item-wl-detail">
                                                <p class="strong"><a href="{{route('product.show', $item->slug)}}">{{$item->name}}</a>
                                                </p>
                                                <p class="item-wl-id">
                                                    Mã sản phẩm: <strong>{{$item->code}}</strong>
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="hidden-xs ">
                                        {{ $statisticCollect->sum(function ($order) {
                                             return $order->pivot->quantity;
                                        }) }}
                                    </td>
                                    <td class="item-wl-{{($item->quantity == 0) ? 'ostock' : 'stock'}} ">{{$item->quantity}}</td>
                                    <td class="item-wl-price ">
                                        {{number_format( 
                                            $statisticCollect->sum(function ($order) {
                                                return $order->pivot->quantity * $order->pivot->price;
                                            })
                                        )}} ₫
                                    </td>
                                    <td class="hidden-xs ">
                                        {{number_format(
                                            $statisticCollect->sum(function ($order) {
                                                return $order->pivot->discount * $order->pivot->quantity;
                                            })
                                        )}} ₫
                                    </td>
                                    <td>
                                        {{number_format(
                                            $statisticCollect->sum(function ($order) {
                                                return ($order->pivot->price - $order->pivot->discount) * $order->pivot->quantity;
                                            })
                                        )}} ₫
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                        <div class="sortPagiBar">
                            <div class="bottom-pagination">
                                <nav>
                                Tổng thực nhận: {{ number_format(
                                    $items->sum(function ($product) use ($dateRange, $dateGroup) {
                                        $dates = explode(' - ', $dateRange);
                                        $orderStatic = $product->orderStatistic($dates[0], $dates[1], $dateGroup)->get();
                                        return (!count($orderStatic)) ? 0 : $orderStatic->sum(function ($order) {
                                            return ($order->pivot->price - $order->pivot->discount) * $order->pivot->quantity;
                                        });
                                    })
                                ) }} ₫
                                </nav>
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    <!-- // DEV -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('body-append')
    @parent
    {{ HTML::script('assets/backend/js/laroute.js') }}
    <script src="/vendor/daterangepicker/moment.min.js"></script>
    <script src="/vendor/daterangepicker/daterangepicker.js"></script>
    <script>
        var dateGroup = '{{ $dateGroup or '' }}';
        $(function (){
            $('body').removeClass('home');
            $('.columns-container').css("background","#fff");
            var table = function () {
                var route = laroute.route('customer.provider.statistic', {date_range: $('#datetime').val(), 'date_group': dateGroup});
                window.location.href = route;
            }
            $('#datetime').daterangepicker({
                }, function (start, end, label) {
                    table();
            });
            $('[data-trigger="export"]').click(function () {
                var route = laroute.route('customer.provider.statistic', {date_range: $('#datetime').val(), 'date_group': dateGroup, 'export': 'xls'});
                window.location.href = route;
            });
            $('[data-trigger="date-group"]').each(function () {
                var group = $(this).data('group');
                if (group == dateGroup) {
                    $(this).addClass('active');
                }
                $(this).click(function (e) {
                    e.preventDefault();
                    $(this).siblings().removeClass('active');
                    $(this).addClass('active');
                    dateGroup = group;
                    table();
                })
            });
        });
    </script>
@endsection
