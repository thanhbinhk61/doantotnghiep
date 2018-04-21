<!-- Product -->
<div id="product-quickview" class="block-quickview mfp-with-anim mfp-hide mfp-dialog">
    <div class="primary-box row">
        <div class="pb-left-column col-xs-12 col-sm-5">
            <!-- product-imge-->
            <div class="product-image">
                <div class="product-full">
                    <img  />
                </div>
            </div>
            <!-- product-imge-->
        </div>
        <div class="pb-right-column col-xs-12 col-sm-6">
            <h3 class="product-name"></h3>
            <div class="product-comments">
                <div class="product-star">
                </div>
            </div>
            <div class="product-price-group">
                <span class="price"></span>
            </div>
            <div class="info-orther">
                <p class="item-code"></p>
            </div>
            <div class="product-desc"></div>
            <div class="form-option">
                <p class="form-option-title">Thuộc tính: </p>
                <div class="select-colors"></div>
                <div class="select-others"></div>
                <div class="attributes">
                    <div class="attribute-label">Số lượng: </div>
                    <span class="text-danger hide quantity-open">Hết hàng</span>
                    <div class="attribute-list product-qty quantity-end">
                        <div class="qty">
                            <input class="option-product-qty-qv"  type="number" value="1">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-action quantity-end">
                <div class="button-group">
                    <a class="btn-add-cart add-form-cart-store-qv" href="#">Thêm vào giỏ</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Product -->

@section('body-append')
    @parent
    {{ HTML::script('assets/backend/js/laroute.js') }}
    <script>
        $(function (){
            $('.click-quickview').magnificPopup({
                closeBtnInside: true,
                callbacks: {
                    open: function () {
                        var magnificPopup = $.magnificPopup.instance,
                            data = magnificPopup.st.el.data('quickview');
                            $.post(laroute.route('product.ajax.quickview'), {value:data}, function (result) {
                                var listedPrice = (result.product.sale == 1 ) ? localeString(result.product.price) + ' ₫' : localeString(result.product.price_sale) + ' ₫';
                                $('#product-quickview').find('.product-full img').attr('src',laroute.route('image.resize', {file:result.product.image,w:480,h:480}));
                                $('#product-quickview').find('h3.product-name').text(result.product.name);
                                $('#product-quickview').find('.product-price-group .price').text(listedPrice);
                                $('#product-quickview').find('.product-desc').text(result.product.intro);
                                if (result.product.status == 3) return;
                                if (result.product.quantity > 0) {
                                    $('#product-quickview').find('.quantity-end').removeClass('hide');
                                    $('#product-quickview').find('.quantity-open').addClass('hide');
                                } else {
                                    $('#product-quickview').find('.quantity-end').addClass('hide');
                                    $('#product-quickview').find('.quantity-open').removeClass('hide');
                                }
                                $('#product-quickview').find('.option-product-qty-qv').change(function () {
                                    if ($(this).val() > result.product.quantity) {
                                        $(this).val(result.product.quantity);
                                    }
                                    if ($(this).val() < 0) {
                                        $(this).val(0);
                                    }
                                });
                                $.each(result.others, function (index, item) {
                                    if(item.length > 1) {
                                    $('#product-quickview').find('.select-others').append('<div class="attributes">\
                                            <div class="attribute-label">Chọn: </div>\
                                            <div class="attribute-list">\
                                                <select class="property-group">'+
                                                    $.map(item, function (val, i) {
                                                        return '<option value="'+val.id+'" data-price="'+val.pivot.price+'">'+val.name+'</option>';
                                                    })+
                                                '</select>\
                                            </div>\
                                        </div>');
                                    }
                                    
                                });
                                if (result.colors.length > 1) {
                                    $('#product-quickview').find('.select-colors').append('<div class="attributes">\
                                        <div class="attribute-label">Màu sắc: </div>\
                                        <div class="attribute-list">\
                                            <ul class="list-color">\
                                            </ul>\
                                        </div>\
                                    </div>');
                                    $.each(result.colors, function (index, item) {
                                        $('#product-quickview').find('ul.list-color').append('<li class="select"><a data-price="'+item.pivot.price+'" data-id="'+item.id+'" class="select-color" href="#">'+item.name+'</a></li>');
                                    });
                                }
                                var color_id = 0;
                                for(var i = 1; i < 6; i ++) {
                                    $('#product-quickview').find('.product-star').append((i<=result.rating) ? '<i class="fa fa-star"></i> ' :  '<i class="fa fa-star-o"></i> ');
                                }
                                $('.select-color').click(function (e) {
                                    e.preventDefault();
                                    //$('#product-quickview').find('.has-warning').text('');
                                    $('.select').removeClass('active')
                                    $(this).parent().addClass('active');
                                    color_id = $(this).data('id');
                                    if ($(this).data('price') != 0) {
                                        $('#product-quickview').find('.product-price-group .price').text(localeString(parseCurrency(listedPrice) + $(this).data('price')) + ' ₫');
                                    }
                                });
                                var idsArray = [];
                                var changePrice = 0;
                                $('#product-quickview').find('.property-group').find("option:selected").map(function() {
                                    changePrice += $(this).data('price');
                                    idsArray.push($(this).val());
                                });
                                $('#product-quickview').find('.product-price-group .price').text(localeString(parseCurrency(listedPrice) + changePrice) + ' ₫');
                                $('#product-quickview').find('.property-group').change(function () {
                                    idsArray = [];
                                    var optionCheck = false;
                                    $(this).find("option").map(function () {
                                        if ($(this).data('price') > 0) optionCheck = true;
                                    });
                                    if (optionCheck) {
                                        $('#product-quickview').find('.product-price-group .price').text(localeString(parseCurrency(listedPrice) + $(this).find("option:selected").data('price')) + ' ₫');
                                    }
                                    $('#product-quickview').find('.property-group').find("option:selected").map(function () {
                                        idsArray.push($(this).val());
                                    });
                                });

                                $('.add-form-cart-store-qv').click(function (e) {
                                    e.preventDefault();
                                    var priceFinal = parseCurrency($('#product-quickview').find('.product-price-group .price').text());
                                    var dataCart = {_method:"POST",quantity:$('.option-product-qty-qv').val(), color_id:color_id,'other_ids':idsArray,'price':priceFinal}
                                    $.post(laroute.route('product.cart.store',{id:data}), dataCart, function (reponse) {
                                        //console.log(reponse);
                                        window.location.reload();
                                    });
                                }); 

                            });
                        },
                    close: function () {
                        $('#product-quickview').find('.product-full img').attr('src','');
                        $('#product-quickview').find('.product-star').children().remove();
                        $('#product-quickview').find('.select-colors').children().remove();
                        $('#product-quickview').find('.select-others').children().remove();

                    }
                },
                midClick: true
            });

            $('.wish-list').click(function (e) {
                var currentURL = window.location.protocol + '//' + window.location.hostname + laroute.route('auth.login');
                if ($(this).attr('href') != currentURL) {
                    e.preventDefault();
                    $.post($(this).attr('href'), function (data) {
                        //console.log(data);
                        window.location.reload();
                    });
                }
            });
        });
    </script>
@endsection