<div class="modal fade page-order" id="card-customer" tabindex="-1" role="dialog" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" id="exampleModalLabel">Thêm mới thông tin tài khoản</h3>
            </div>
            <div class="modal-body">
            {!! Form::open(['url' => route('customer.card.post'), 'autocomplete'=>'off']) !!}
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
                            <label for="name" class="control-label">Tên tài khoản</label>
                            {!! Form::text('name',null, ['class' => 'form-control','placeholder' => 'Tên tài khoản']) !!}
                        </div>
                        <div class="col-sm-4">
                            <label for="number" class="control-label">Số tài khoản</label>
                            {!! Form::text('number',null, ['class' => 'form-control','placeholder' => 'Số tài khoản']) !!}
                        </div>
                        <div class="col-sm-4">
                            <label for="bank" class="control-label">Ngân hàng:</label>
                            {!! Form::text('bank',null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <label>Chi nhánh</label>
                    {!! Form::text('address',null, ['class' => 'form-control']) !!}
                </div>

                <button type="submit" class="button">Thêm mới</button>
                <hr>
            {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

