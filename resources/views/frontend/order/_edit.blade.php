<div class="modal fade" id="edit-guest" tabindex="-1" role="dialog" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" id="exampleModalLabel">Cập nhật thông tin</h3>
            </div>
            <div class="modal-body">
            {!! Form::model($item, ['method' => 'PATCH', 'url' => route('order.update.guest', $item->id), 'autocomplete'=>'off']) !!}
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="name" class="control-label">Tên:</label>
                            {!! Form::text('name',null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="col-sm-6">
                            <label for="email" class="control-label">Email:</label>
                            {!! Form::email('email',null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="phone" class="required">Số điện thoại</label>
                            {!! Form::text('phone',null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="col-sm-6">
                            <label for="ship_id" class="required">Khu vực</label>
                            {!! Form::select('ship_id', $shipList , $order->expense_id, ['class' => 'input form-control select-category change-price']) !!}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Địa chỉ giao hàng</label>
                    {!! Form::text('address',null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    <label>Lời nhắn</label>
                    {!! Form::textarea('note',null, ['class' => 'input form-control','rows'=>'3']) !!}
                </div>

                <button type="submit" class="button">Cập nhật</button>
                <hr>
                <h4>Thông tin giao hàng</h4>
                <p><i class="fa fa-check-circle text-primary" ></i> <span id="regions-price"> G.hàng tại {{$order->expense->name}} chi phí: {{number_format($order->ship)}} ₫</span></p>
            {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@section('body-append')
    @parent
    {{ HTML::script('assets/backend/js/laroute.js') }}
    <script>
        var totalOrder = parseCurrency({{Cart::total()}});
        $(function (){
            $('.change-price').change(function() {
                var id = $(this).val();
                $.post(laroute.route('order.ajax.expense'), {id:id}, function (results) {
                    var priceChange = (results) ? parseCurrency(results.price) : 0;
                    $('.shipping-price').text(localeString(priceChange) + ' ₫');
                    $('.total-order').text(localeString(totalOrder + priceChange) + ' ₫');
                    $('#regions-price').text(' G.hàng tại ' + results.name + ' chi phí: ' + localeString(priceChange) + ' ₫');
                });
            });
        });
    </script>
@endsection
