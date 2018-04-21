<div class="modal fade page-order" id="find-order" tabindex="-1" role="dialog" >
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" id="exampleModalLabel">Tra cứu đơn hàng</h3>
            </div>
            <div class="modal-body">
            {!! Form::open(['url' => route('order.find.post'), 'autocomplete'=>'off']) !!}

                <div class="form-group">
                    <label>Mã đơn hàng</label>
                    {!! Form::text('code',null, ['class' => 'form-control code-order','placeholder' => 'Mã đơn hàng']) !!}
                </div>
                @if (!$me)
                <div class="form-group">
                    <label>Email</label>
                    {!! Form::email('email',null, ['class' => 'form-control','required','placeholder' => 'Email']) !!}
                </div>
                @endif

                <button type="submit" class="button" id="check-order-action"><i class="fa fa-hand-o-right"></i> Kiểm tra đơn hàng</button>
                <hr>
                <p class="text-danger hide">Bạn phải nhập mã đơn hàng</p>
            {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@section('body-append')
    @parent
    <script>
        $(function (){
            $('#find-order').on('show.bs.modal', function (event) {
                var modal = $(this);
                $(modal.find('p.text-danger')).addClass('hide');
                modal.find('#check-order-action').click(function (e) {
                    if (modal.find('input[name="code"]').val().length === 0) {
                        e.preventDefault();
                        $(modal.find('p.text-danger')).removeClass('hide');
                    }
                });
            })
        });
    </script>
@endsection

