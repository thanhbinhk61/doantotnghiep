@extends('layouts.backend')
@section('title',isset($heading) ? $heading : '')
@section('head-append')
    @parent
    {{ HTML::style("assets/backend/css/plugins/dataTables/datatables.min.css") }}
@endsection

@section ('body-append')
    @parent
    {{ HTML::script("assets/backend/js/plugins/dataTables/datatables.min.js") }}
    <script>
        var flash_message = '{!!session("flash_message")!!}';
        $(function () {
            renderTable('{!! route('admin.customer.data.order',$item->id) !!}',
                [
                    { data: 'id', name: 'id', searchable: false },
                    { data: 'code', name: 'cide'},
                    { data: 'total', name: 'total'},
                    { data: 'ship', name: 'ship'},
                    { data: 'status', name: 'status'}
                ],{
                    dom: '<"html5buttons"B>lTfgitp',
                    buttons: [ ],
                createdRow: function ( row, data, index ) {
                    $('td', row).eq(0).css('display','none');
                    $('td', row).eq(1).html('<a title="Xem" href="'+laroute.route('admin.order.show',{order:data.id})+'">'+data.code+'</a>');
                    $('td', row).eq(2).html(toLocaleCurrency(data.total));
                    $('td', row).eq(3).html(toLocaleCurrency(data.ship));
                }
            });

            $('.delete-handle').click(function (e) {
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

@section('page-content')
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-md-7">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>{!!$heading or ''!!}</h5>
                        <div class="ibox-tools">
                            <a  href="{{route('admin.customer.edit',$item->id)}}">
                                <i class="fa fa-wrench"></i>
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
                                    <tr>
                                        <th>phone</th>
                                        <td>{{$item->name}}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{$item->email}}</td>
                                    </tr>
                                    <tr>
                                        <th>Address</th>
                                        <td>{{$item->address}}</td>
                                    </tr>
                                    <tr>
                                        <th>Age</th>
                                        <td>{{$item->age}}</td>
                                    </tr>
                                    <tr>
                                        <th>Đơn hàng đã mua</th>
                                        <td><span class="label label-primary">{{count($item->orders)}}</span></td>
                                    </tr>
                                    <tr>
                                        <th>Tổng tiền</th>
                                        <td><span class="label label-primary">{{number_format($item->orders->sum('total'))}}</span></td>
                                    </tr>
                                    <tr>
                                        <th>Ngày tạo</th>
                                        <td>{{$item->created_at}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="ibox float-e-margins">        
                    <div class="ibox-title">
                        <h5>Sổ địa chỉ</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-down"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Tên</th>
                                        <th>Số điện thoại</th>
                                        <th>Địa chỉ</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($addresses as $address)
                                    <tr>
                                        <th>{{$address->name}}</th>
                                        <td>{{$address->phone}}</td>
                                        <td>{{$address->address}}</td>
                                        @can('customer-write')
                                        <td><a href="{{route('admin.customer.address.destroy',$address->id)}}" class="btn btn-danger btn-xs delete-handle"><i class="fa fa-times"></i></a></td>
                                        @endcan
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="ibox float-e-margins">        
                    <div class="ibox-title">
                        <h5>Tài khoản thanh toán</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-down"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Tên</th>
                                        <th>Số Thẻ</th>
                                        <th>Ngân hàng</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($cards as $card)
                                    <tr>
                                        <th>{{$card->name}}</th>
                                        <td>{{$card->number}}</td>
                                        <td>{{$card->bank}}</td>
                                        @can('customer-write')
                                        <td><a href="{{route('admin.customer.card.destroy',$card->id)}}" class="btn btn-danger btn-xs delete-handle"><i class="fa fa-times"></i></a></td>
                                        @endcan
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="ibox float-e-margins">        
                    <div class="ibox-title">
                        <h5>Danh sách đơn hàng</h5>
                    </div>
                    <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover prome-datatables" width="100%">
                            <thead>
                                <tr>
                                    <th style="display:none">ID</th>
                                    <th>Code</th>
                                    <th>Số tiền</th>
                                    <th>Phí ship</th>
                                    <th>Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>

@endsection
