<div class="modal fade page-order" id="order-ship" tabindex="-1" role="dialog" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" id="exampleModalLabel">Order Ship hàng</h3>
            </div>
            <div class="modal-body">
            {!! Form::open(['url' => route('ship.post'), 'autocomplete'=>'off']) !!}

                <div class="form-group">
                    <label>Link sản phẩm <span class="text-danger">*</span></label>
                    {!! Form::text('link',null, ['class' => 'form-control','placeholder' => 'http://']) !!}
                </div>

                @if (!$me)
                <div class="form-group">
                    <label>Tên <span class="text-danger">*</span></label>
                    {!! Form::text('name',null, ['class' => 'form-control','placeholder' => 'Tên']) !!}
                </div>

                <div class="form-group">
                    <label>Email <span class="text-danger">*</span></label>
                    {!! Form::email('email',null, ['class' => 'form-control','required','placeholder' => 'Email']) !!}
                </div>

                <div class="form-group">
                    <label>Số điện thoại</label>
                    {!! Form::text('phone',null, ['class' => 'form-control','placeholder' => 'Số điện thoại']) !!}
                </div>

                <div class="form-group">
                    <label>Địa chỉ</label>
                    {!! Form::text('address',null, ['class' => 'form-control','placeholder' => 'Địa chỉ']) !!}
                </div>
                @endif

                <div class="form-group">
                    <label>Lời nhắn</label>
                    {!! Form::textarea('note',null, ['class' => 'form-control','rows'=>'3','placeholder' => 'Gửi nhiều Link order Http://, Http://']) !!}
                </div>

                <button type="submit" class="button" id="validation-order-ship"><i class="fa fa-hand-o-right"></i> Gửi sản phẩm order</button>
                <hr>
                <p class="text-danger hide"></p>
            {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@section('body-append')
    @parent
    <script>
        $(function (){
            $('#order-ship').on('show.bs.modal', function (event) {
                var modal = $(this);
                $(modal.find('p.text-danger')).addClass('hide');
                modal.find('#validation-order-ship').click(function (e) {
                    if (modal.find('input[name="link"]').val().length === 0) {
                        e.preventDefault();
                        $(modal.find('p.text-danger')).text('Bạn phải nhập link sản phẩm').removeClass('hide');
                    } 
                });
            })
        });
    </script>
@endsection


