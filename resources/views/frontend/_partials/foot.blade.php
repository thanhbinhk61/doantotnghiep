{!! HTML::script('assets/frontend/lib/jquery/jquery-1.11.2.min.js') !!}
{!! HTML::script('assets/frontend/lib/bootstrap/js/bootstrap.min.js') !!}
{!! HTML::script('assets/frontend/lib/select2/js/select2.min.js') !!}
{!! HTML::script('assets/frontend/lib/jquery.bxslider/jquery.bxslider.min.js') !!}
{!! HTML::script('assets/frontend/lib/owl.carousel/owl.carousel.min.js') !!}
{!! HTML::script('assets/frontend/lib/countdown/jquery.plugin.js') !!}
{!! HTML::script('assets/frontend/lib/countdown/jquery.countdown.js') !!}
{!! HTML::script('assets/frontend/lib/fancyBox/jquery.fancybox.js') !!}
{!! HTML::script('assets/frontend/lib/magnific.js') !!}
{!! HTML::script('assets/frontend/js/typeahead.bundle.min.js') !!} <!-- Form-typeahead -->
{!! HTML::script('assets/frontend/js/jquery.actual.min.js') !!}
{{ HTML::script('assets/backend/js/plugins/toastr/toastr.min.js') }}
{{ HTML::script('assets/frontend/js/jquery.lazyload.min.js') }}
{!! HTML::script('assets/frontend/js/theme-script.js') !!}
{!! HTML::script('assets/frontend/js/option4.js') !!}

<script type="text/javascript">
var flash_message_frontend = '{!!session("flash_message_frontend")!!}';
var errors = '{{ (count($errors) > 0) ? $errors->first() : null }}' ;
if (errors != 'undefined' && errors) {
    flash_message_frontend = '{"code":100,"message":"' + errors + '"}';
}

$("img.lazy").lazyload({
    effect : "fadeIn",
});

function localeString(x, sep, grp) {
    var sx = (''+x).split('.'), s = '', i, j;
    sep || (sep = ','); // default seperator
    grp || grp === 0 || (grp = 3); // default grouping
    i = sx[0].length;
    while (i > grp) {
        j = i - grp;
        s = sep + sx[0].slice(j, i) + s;
        i = j;
    }
    s = sx[0].slice(0, i) + s;
    sx[0] = s;
    return sx.join('.')
}
function parseCurrency(s) {
    var i = parseInt(s.toString().replace(/,/g, ""), 10);
    return isNaN(i) ? 0 : i;
}
 $(function () {
    if (typeof flash_message_frontend !== 'undefined' && flash_message_frontend) {
        var e = JSON.parse(flash_message_frontend);
        toastr.options = {
            "closeButton": true,
            "debug": true,
            "progressBar": false,
            "preventDuplicates": true,
            "positionClass": "toast-top-right",
            "onclick": null,
            "showDuration": "400",
            "hideDuration": "600",
            "timeOut": "2000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        e.code == 0 ? toastr.success(e.message) : toastr.error(e.message);
    }
 	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.product-price').text().replace(/,/g, ".");

    $('#toolbar-search input').typeahead(
    {
        highlight: true,
        limit:5,
        minLength: 2
    },
    {
        limit: 5,
        name: 'products',
        displayKey: 'name',
        source: function (query, syncResults, asyncResults) {
            $.post(laroute.route('product.ajax.search'), {query: query}, function (data) {
                asyncResults(data);
            });
        },
        templates: {
            suggestion: function (product) {

                return '<div class="item"><p>' + product.name +'</p></div>';
            },
            empty: function (a) {
                return '<div class="item tt-suggestion"><p class="tt-suggestion">Rất tiếc chúng tôi không tìm thấy sản phẩm. </p></div>';
            }
        }
    }).on('typeahead:selected', function (e, data) {
            window.location.replace(laroute.route('product.show',{slug:data.slug}));
    });

 })
</script>
{!!$configs->scripts!!}
<script>
(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.3&appId=354747788058341";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

jQuery(document).ready(function(){
jQuery('.online-support').hide();
jQuery('.support-icon-right h3').click(function(e){
e.stopPropagation();
jQuery('.online-support').slideToggle();
});
jQuery('.online-support').click(function(e){
e.stopPropagation();
});
jQuery(document).click(function(){
jQuery('.online-support').slideUp();
});
});
</script>

