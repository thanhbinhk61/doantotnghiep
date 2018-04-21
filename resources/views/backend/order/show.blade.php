@extends('layouts.backend')
@section('title',isset($heading) ? $heading : '')

@section('page-content')
    
    <div class="wrapper wrapper-content">
        <div class="row visible-print">
            <div class="col-md-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        <div class="clearfix">
                            <div class="pull-left">
                                <p><img src="{{asset('assets/frontend/images/logo.png')}}"></p>
                                <strong>Công ty Cổ phần Umzila Group</strong>
                                <p class="no-margin"><strong>Địa chỉ:</strong> 21 Phan Bội Châu, H.Kiếm, HN</p>
                                <p class="no-margin"><strong>Điện thoại:</strong> 0466.872.558</p>
                            </div>
                            <div class="pull-right">
                                <h3>Thông tin đơn hàng</h3>
                                <span>Ngày tạo: {{date('d/m/Y H:i', strtotime($item->created_at))}}</span>
                            </div>
                        </div>      
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>{!!$heading or ''!!}</h5>
                        <div class="ibox-tools hidden-print" title="In">
                            <a href="javascript:window.print()" >
                                <i class="fa fa-print"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Code</th>
                                        <td>#{{$item->code}}</td>
                                    </tr>
                                    @if (count($item->addressCustomer))
                                    <tr>
                                        <th>Tên</th>
                                        <td>{{$item->addressCustomer->name}}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{$item->customer->email}}</td>
                                    </tr>
                                    <tr>
                                        <th>Số điện thoại</th>
                                        <td>{{$item->addressCustomer->phone}}</td>
                                    </tr>
                                    <tr>
                                        <th>Địa chỉ gửi</th>
                                        <td>{{$item->addressCustomer->address}}</td>
                                    </tr>
                                    @else
                                    <tr>
                                        <th>Tên</th>
                                        <td>{{($item->customer_id == 0) ? $item->name : $item->customer->name}}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{($item->customer_id == 0) ? $item->email : $item->customer->email}}</td>
                                    </tr>
                                    <tr>
                                        <th>Số điện thoại</th>
                                        <td>{{($item->customer_id == 0) ? $item->phone : $item->customer->phone}}</td>
                                    </tr>
                                    <tr>
                                        <th>Địa chỉ gửi</th>
                                        <td>{{($item->customer_id == 0) ? $item->address : $item->customer->address}}</td>
                                    </tr>
                                    @endif
                                    @if ($item->expense)
                                    <tr>
                                        <th>Khu vực</th>
                                        <td>{{$item->expense->name}}</td>
                                    </tr>
                                    @endif
                                    @if ($item->customer)
                                    <tr>
                                        <th>Khách hàng</th>
                                        <td>@if ($item->customer->category) <span class="label label-primary"> {{ $item->customer->category->name}} </span> @endif</td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <th>Ghi chú</th>
                                        <td>{{$item->note}}</td>
                                    </tr>
                                    <tr>
                                        <th>tổng tiền</th>
                                        <td><b>{{number_format($item->total)}}<b> ₫</td>
                                    </tr>
                                    <tr>
                                        <th>Phí vận chuyển</th>
                                        <td><b>{{number_format($item->ship)}}<b> ₫</td>
                                    </tr>
                                    @if ($item->coupon)
                                    <tr class="hidden-print">
                                        <th>Đã Giảm giá</th>
                                        <td>
                                            <a class="label label-primary" href="{{route('admin.coupon.edit',$item->coupon->id)}}">{{number_format($item->coupon->value)}} {{ ($item->coupon->type == 1) ? '%' : '₫' }}</a>
                                            <span class="label label-primary pull-left"></span>
                                        </td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <th>Tổng chi phí</th>
                                        <td><b>{{number_format($item->ship + $item->total)}}<b> ₫</td>
                                    </tr>
                                    <tr class="hidden-print">
                                        <th>Ngày tạo</th>
                                        <td>{{$item->created_at}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Sản phẩm trong giỏ hàng</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table shoping-cart-table">
                                <thead>
                                    <tr>
                                        <th class="hidden-print">Hình ảnh</th>
                                        <th>Thông tin</th>
                                        <th>Đơn giá</th>
                                        <th>Số lượng</th>
                                        <th>Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if (count($products))
                                @foreach ($products as $product)
                                <tr>
                                    <td width="90" class="hidden-print">
                                        <img src="{{route('image.resize',[$product->image,90,90])}}">
                                    </td>
                                    <td class="desc" width="30%">
                                        <h3>
                                        <p class="small visible-print">{{$product->name}}</p>
                                        <a href="{{route('admin.product.show',$product->id)}}" class="text-navy hidden-print">
                                            {{$product->name}}
                                        </a>
                                        </h3>
                                        <p class="small hidden-print">{{mb_substr($product->intro,0,25,'UTF-8')}}</p>
                                        <p class="small">{{$product->pivot->color}}</p>
                                        @if($product->pivot->other != 0)
                                        <p class="small">
                                           <?php
                                                $properties = [];
                                                $ids = explode(',',$product->pivot->other);
                                                if(count($ids)) {
                                                    foreach ($ids as $key) {
                                                        $properties[] = $product->others->keyBy('id')[$key]['name'];
                                                    }
                                                } else {
                                                    $properties[] = $product->others->keyBy('id')[$ids]['name'];
                                                }
                                                echo implode(', ', $properties);
                                            ?>
                                        </p>
                                        @endif
                                    </td>

                                    <td class="desc">
                                        {{number_format($product->pivot->price)}} ₫
                                    </td>
                                    <td width="95" class="desc">
                                        {{$product->pivot->quantity}}
                                    </td>
                                    <td class="desc">
                                        <h4>
                                            {{number_format($product->pivot->price * $product->pivot->quantity)}} ₫
                                        </h4>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="ibox-footer hidden-print">
                        @if($item->status != 88)
                        {!! Form::model($item, ['method' => 'PATCH', 'url' => route('admin.order.update', $item->id)]) !!}
                            <div class="row">
                                <div class="col-sm-4">
                                    <button class="btn btn-primary" type="submit"><i class="fa fa fa-shopping-cart"></i> Cập nhật trạng thái</button>
                                </div>
                                <div class="col-sm-5">
                                    {!! Form::select('status', $optionStatus , null, ['class' => 'form-control']) !!}
                                </div>
                            </div>                            
                        {!!Form::close()!!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
