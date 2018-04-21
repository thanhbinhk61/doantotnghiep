<div class="modal fade page-order" id="address-customer" tabindex="-1" role="dialog" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" id="exampleModalLabel">Thêm mới sổ địa chỉ</h3>
            </div>
            <div class="modal-body">
            {!! Form::open(['url' => route('customer.address.post'), 'autocomplete'=>'off']) !!}
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
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="name" class="control-label">Họ & Tên:</label>
                            {!! Form::text('name',null, ['class' => 'form-control','placeholder' => 'Họ và tên']) !!}
                        </div>
                        <div class="col-sm-4">
                            <label for="phone" class="control-label">Điện thoại:</label>
                            {!! Form::text('phone',null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="col-sm-4">
                            <label for="ship_id" class="required">Tỉnh / Thành phố</label>
                            {!! Form::select('ship_id', $shipList , null, ['class' => 'input form-control select-category']) !!}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Địa chỉ giao hàng</label>
                    {!! Form::text('address',null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    <label>Chi tiết</label>
                    {!! Form::textarea('description',null, ['class' => 'input form-control','rows'=>'3']) !!}
                </div>

                <button type="submit" class="button">Thêm mới</button>
                <hr>
            {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

