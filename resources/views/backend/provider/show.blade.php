@extends('layouts.backend')
@section('title',isset($heading) ? $heading : '')

@section('head-append')
    @parent
{{ HTML::style('vendor/daterangepicker/daterangepicker-bs3.css')}}
@endsection

@section('page-content')
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-md-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>{!!$heading or ''!!}</h5>
                        <div class="ibox-tools">
                            <a  href="{{route('admin.provider.edit',$item->id)}}">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <a class="collapse-link">
				                <i class="fa fa-chevron-down"></i>
				            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Name</th>
                                        <td>{{$item->name}}</td>
                                    </tr>
                                    @if (count($items))
                                    <tr>
                                        <th>Tổng thực nhận</th>
                                        <td>
                                        	{{ number_format(
			                                    $items->sum(function ($product) use ($dateRange, $dateGroup) {
			                                        $dates = explode(' - ', $dateRange);
			                                        $orderStatic = $product->orderStatistic($dates[0], $dates[1], $dateGroup)->get();
			                                        return (!count($orderStatic)) ? 0 : $orderStatic->sum(function ($order) {
			                                            return ($order->pivot->price - $order->pivot->discount) * $order->pivot->quantity;
			                                        });
			                                    })
			                                ) }} ₫
                                        </td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="ibox float-e-margins">        
                    <div class="ibox-title">
                        <h5>Danh sách đơn hàng</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
				                <i class="fa fa-chevron-down"></i>
				            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
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
	                    <div class="table-responsive">
	                        <table class="table table-striped table-bordered table-hover prome-datatables" width="100%">
	                            <thead>
	                                <tr>
	                                    <th >Sản phẩm</th>
	                                    <th >Thông tin</th>
		                                <th class="hidden-xs">Đã bán</th>
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
	                                    </td>
	                                    <td class="desc">
	                                    	<a href="{{route('product.show', $item->slug)}}">{{str_limit($item->name,20)}}</a>
	                                    	<p><strong>#{{$item->code}}</strong></p>
	                                    </td>
	                                    <td class="hidden-xs ">
	                                        {{ $statisticCollect->sum(function ($order) {
	                                             return $order->pivot->quantity;
	                                        }) }}
	                                    </td>
	                                    <td >
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
	                    </div>
	                </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('body-append')
    @parent
    <script src="/vendor/daterangepicker/moment.min.js"></script>
    <script src="/vendor/daterangepicker/daterangepicker.js"></script>
    <script>
        var dateGroup = '{{ $dateGroup or '' }}';
        var providerId = '{!! $providerId !!}';
        $(function (){
            $('body').removeClass('home');
            $('.columns-container').css("background","#fff");
            var table = function () {
                var route = laroute.route('admin.provider.show', {provider: providerId, date_range: $('#datetime').val(), 'date_group': dateGroup});
                window.location.href = route;
            }
            $('#datetime').daterangepicker({
                }, function (start, end, label) {
                    table();
            });
            $('[data-trigger="export"]').click(function () {
                var route = laroute.route('admin.provider.show', {provider: providerId, date_range: $('#datetime').val(), 'date_group': dateGroup, 'export': 'xls'});
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
