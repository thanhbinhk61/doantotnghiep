<div class="modal fade" id="address_info" tabindex="-1" role="dialog" >
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" id="exampleModalLabel">Thông tin địa chỉ giao hàng</h3>
            </div>
            <div class="modal-body">
                <p class="info"><i class="fa fa-check text-primary" ></i> <span class="address-name"></span></p>
                <p class="info"><i class="fa fa-check text-primary" ></i> <span class="address-phone"></span></p>
                <p class="info"><i class="fa fa-check text-primary" ></i> <span class="address-address"></span></p>
                <p class="info"><i class="fa fa-check text-primary" ></i> <span class="address-description"></span></p>
                <hr>
                <p><i class="fa fa-truck text-primary" ></i> <span class="value-ship" ></span></p>
            </div>
        </div>
    </div>
</div>

@section('body-append')
    @parent
    <script>
        var addresses = '{!!$me->addresses->load(["expense"])!!}';
        $(function (){
            $('#address_info').on('show.bs.modal', function (event) {
                var id = $(event.relatedTarget).data('id');
                var data = JSON.parse(addresses);
                var result = $.grep(data, function (e, i) {
                                return e.id == id;
                            });
                if (result.length) {
                    
                    $(this).find('span.address-name').text('Tên: ' + result[0].name);
                    $(this).find('span.address-phone').text('Điện thoại: ' + result[0].phone);
                    $(this).find('span.address-address').text('Địa chỉ: ' + result[0].address);
                    $(this).find('span.address-description').text('Chi tiết: ' + result[0].description);
                    $(this).find('span.value-ship').text(' G.hàng tại  ' + result[0].expense.name + ' chi phí: ' + localeString(result[0].expense.price) + ' ₫');
                }
            })
        });
    </script>
@endsection
