@extends('layouts.backend')

@section('title',isset($heading) ? $heading : 'Danh sách')

@section('page-content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-info pull-right">Hôm nay</span>
                    <h5>Đơn hàng</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">{{ isset($orderToday) ? number_format($orderToday->sum('total')) : 0}} ₫</h1>
                    <div class="stat-percent font-bold text-info">{{count($orderToday)}} <i class="fa fa-check-square-o"></i></div>
                    <small><a href="{{route('admin.order.index')}}">Chi tiết</a></small>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-info pull-right">Trong tháng</span>
                    <h5>Đơn hàng</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">{{ isset($orderMonthday) ? number_format($orderMonthday->sum('total')) : 0}} ₫</h1>
                    <div class="stat-percent font-bold text-info">{{count($orderMonthday)}} <i class="fa fa-check-square-o"></i></div>
                    <small><a href="{{route('admin.order.index')}}">Chi tiết</a></small>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-info pull-right">Trong năm</span>
                    <h5>Đơn hàng</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">{{ isset($orderYearday) ? number_format($orderYearday->sum('total')) : 0}} ₫</h1>
                    <div class="stat-percent font-bold text-info">{{count($orderYearday)}} <i class="fa fa-check-square-o"></i></div>
                    <small><a href="{{route('admin.order.index')}}">Chi tiết</a></small>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-info pull-right">Chưa xác nhận</span>
                    <h5>Đơn hàng</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">{{ isset($orderNoActive) ? number_format($orderNoActive->sum('total')) : 0}} ₫</h1>
                    <div class="stat-percent font-bold text-info">{{count($orderNoActive)}} <i class="fa fa fa-exclamation-triangle"></i></div>
                    <small><a href="{{route('admin.order.index')}}">Chi tiết</a></small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection