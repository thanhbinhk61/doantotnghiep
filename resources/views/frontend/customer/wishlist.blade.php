@extends('layouts.frontend')

@section('head-append')
    @parent
{{ HTML::style('assets/backend/css/plugins/sweetalert/sweetalert.css')}}
@endsection

@section('page-content')

@include('frontend._partials.quickview')
<div class="columns-container">
    <div class="container" id="columns">
        <div class="row">
            <div class="center_column col-xs-12 col-sm-3" id="left_column">
            @include('frontend.customer._left')
            </div>
            <div class="col-sm-9">
                <div class="box-authentication">
                    <div class="row">
                    <!-- DEV  -->
                    <div class="col-md-12">
                        <table class="table table-hover" id="wish-list">
                            <thead>
                              <tr>
                                <th style="width: 45%">Sản phẩm</th>
                                <th class="text-center hidden-xs">Ngày</th>
                                <th class="text-center">Trạng thái</th>
                                <th class="text-center">Giá</th>
                                <th class="hidden-xs"></th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach($items as $item)
                                <tr>
                                    <th>
                                        <a href="{{route('product.show', $item->slug)}}" class="item-wl-img">
                                            <img src="{{asset($item->image)}}">
                                        </a>
                                        <div class="hidden-xs">
                                            <div class="item-wl-detail">
                                                <p class="strong"><a href="{{route('product.show', $item->slug)}}">{{$item->name}}</a>
                                                </p>
                                                <p class="item-wl-id">
                                                    Mã sản phẩm: <strong>{{$item->code}}</strong>
                                                </p>
                                                <!-- Product Remove Button -->
                                                <p>
                                                    <a class="item-wl-delete" href="{{route('customer.wishlist.destroy',$item->id)}}">Xóa khỏi danh sách</a>
                                                </p>
                                            </div>
                                        </div>
                                    </th>

                                    <th class="text-center hidden-xs">{{date('d/m/Y', strtotime($item->created_at))}}</th>
                                    <th class="item-wl-{{($item->quantity == 0) ? 'ostock' : 'stock'}} text-center">{{($item->quantity == 0) ? 'Hết hàng' : 'Còn hàng'}}</th>
                                    <th class="item-wl-price text-center">
                                        {{ ($item->sale == 2) ? number_format($item->price_sale) : number_format($item->price)}} ₫</th>
                                    <th class="hidden-xs">
                                        <a data-quickview="{{$item->id}}" href="#product-quickview" class="item-wl-buy click-quickview">Xem nhanh</a>
                                    </th>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="sortPagiBar clearfix">
                            <div class="bottom-pagination">
                                <nav>
                                  {{$items->render()}}
                                </nav>
                            </div>
                        </div>
                    </div>
                    
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
    {{ HTML::script('assets/backend/js/plugins/sweetalert/sweetalert.min.js') }}
    <script>
        $(function (){
            $('body').removeClass('home');
            $('.columns-container').css("background","#fff");

            $('.item-wl-delete').click(function (e) {
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