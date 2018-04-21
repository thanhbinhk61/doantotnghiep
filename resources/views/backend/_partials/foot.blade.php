<!-- Mainly scripts -->
{{ HTML::script("assets/backend/js/jquery-2.1.1.js") }}
{{ HTML::script('assets/backend/js/laroute.js') }}
{{ HTML::script("assets/backend/js/plugins/jquery-ui/jquery-ui.min.js") }}
{{ HTML::script("assets/backend/js/bootstrap.min.js") }}
{{ HTML::script("assets/backend/js/plugins/metisMenu/jquery.metisMenu.js") }}
{{ HTML::script("assets/backend/js/plugins/slimscroll/jquery.slimscroll.min.js") }}
{{ HTML::script('assets/backend/js/plugins/sweetalert/sweetalert.min.js') }}
{{ HTML::script('assets/backend/js/plugins/toastr/toastr.min.js') }}
{{ HTML::script("assets/backend/js/inspinia.js") }}
<script>
function sendFile(file) {
    var  data = new FormData();
    data.append("image", file);
    var url = laroute.route('admin.image.ajax');
    $.ajax({
        data: data,
        type: "POST",
        url: url,
        cache: false,
        contentType: false,
        processData: false,
        success: function(url) {
            //console.log(url);
            $(".textarea-summernote").summernote("insertImage", url); 
        },
        error: function(xhr, textStatus, error) {
            console.log(error);
            alert('Đã có lỗi xảy ra..! Bức ảnh quá lớn hoặc vì lý do nào khác không thể insert..!');
        }
    });
}

function uuid() {
    var S4 = function() {
       return (((1+Math.random())*0x10000)|0).toString(16).substring(1);
    };
    return (S4()+S4()+"-"+S4()+"-"+S4()+"-"+S4()+"-"+S4()+S4()+S4());
}
            
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
function toLocaleCurrency(s) {
    return localeString(parseCurrency(s));
}

jQuery(document).ready(function($) {
    if (typeof flash_message !== 'undefined' && flash_message) {
        var e = JSON.parse(flash_message);
        toastr.options = {
            "closeButton": true,
            "debug": true,
            "progressBar": true,
            "preventDuplicates": true,
            "positionClass": "toast-top-right",
            "onclick": null,
            "showDuration": "400",
            "hideDuration": "600",
            "timeOut": "7000",
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

    $('.slim-scroll').slimscroll({
        height: 350
    });

    $('.update-notification').on('click',function(e) { 
        e.preventDefault();
        var $this = $(this);
        $.post(laroute.route('admin.notification.update',{notification:$this.data('id') ,_method: 'PATCH'}), function (data) {
            window.location.replace($this.attr('href'));
        });
    });
});
function renderTable(route, columns, options, callback, selector) {
    var selector = selector || ".prome-datatables";
    var defaultOptions = {
        processing: true,
        serverSide: true,
        ajax: route,
        language: {
            infoFiltered: " - lọc từ _MAX_ kết quả",
            infoEmpty: "Không có bản ghi nào để hiển thị",
            info: "Hiển thị _START_ đến _END_ của _TOTAL_ kết quả",
            lengthMenu: "_MENU_",
            zeroRecords: "Không có kết quả nào",
            processing: "Đang xử lý",
            "paginate": {
                "next": "Trang sau",
                "previous": "Trang trước"
            }

        },
        sorting: [0,'desc'],
        columns: columns,
    };
    options = $.extend(defaultOptions, options);
    var columns = columns || [];
    $(selector).DataTable(options);
    // $('.dataTables_filter input').attr('placeholder','Search...');
    // $('.panel-ctrls').append($('.dataTables_filter').addClass("pull-right")).find("label").addClass("panel-ctrls-center");
    // $('.panel-ctrls').append("<i class='separator'></i>");
    // $('.panel-ctrls').append($('.dataTables_length').addClass("pull-left")).find("label").addClass("panel-ctrls-center");
    // $('.panel-footer').append($(".dataTable+.row"));
    // $('.dataTables_paginate>ul.pagination').addClass("pull-right m-n");
    if (typeof callback === 'function') setTimeout(callback, 500);
}
</script>
