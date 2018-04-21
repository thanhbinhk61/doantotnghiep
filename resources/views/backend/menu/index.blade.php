@extends('layouts.backend')

@section('title',isset($heading) ? $heading : 'Danh sách')

@section('head-append')
    @parent
    <style>
    .positison-relative {
        position: relative;
    }
    </style>
@endsection

@section('page-content')
<div class="wrapper wrapper-content">
    <div class="row">
        @can('menu-write')
        <div class="col-sm-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab-link" data-button="link" data-toggle="tab" class="group-menu" >Link</a></li>
                        <li><a href="#tab-pages" data-button="pages" data-toggle="tab" class="group-menu" >Pages</a></li>
                        <li><a href="#tab-category-post" data-button="category-post" data-toggle="tab" class="group-menu">Bài viết</a></li>
                        <li><a href="#tab-category-product" data-button="category-product" data-toggle="tab" class="group-menu">Sản phẩm</a></li>
                    </ul>
                </div>
                <div class="ibox-content">
                    <div class="slim-scroll">
                        <div class="tab-content">
                            <!-- Tab - Link -->
                            <div class="tab-pane active" id="tab-link">
                                <div class="form-group">
                                    <label>Name</label> 
                                    <input type="text" placeholder="Name" required="required" name="name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Link</label> 
                                    <input type="text" placeholder="http://" name="link" class="form-control">
                                </div>
                            </div>
                            <!-- END Tab - Link -->

                            <!-- Tab - Page -->
                            <div class="tab-pane" id="tab-pages">
                                @foreach($pages as $id => $name)
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><input value="{{$id}}" type="checkbox" class=" check-menu"></span>
                                    <input name ="name" type="text" value="{{$name}}" class="form-control">
                                </div>
                                @endforeach
                                 
                            </div>
                            <!-- END Tab - Page -->

                                <!-- Tab - Category Posts -->
                            <div class="tab-pane" id="tab-category-post">
                                @foreach($categoryPost as $id => $name)
                                    <div class="input-group m-b">
                                        <span class="input-group-addon"><input value="{{$id}}" type="checkbox" class=" check-menu"></span>
                                        <input type="text" value="{{$name}}" class="form-control">
                                    </div>
                                @endforeach
                            </div>
                                <!-- END Tab - Category Post -->

                                                    <!-- Tab - Category Product -->
                            <div class="tab-pane" id="tab-category-product">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><input type="checkbox" class="check-all"></span>
                                    <input type="text" value="Chọn tất cả" disabled="disabled" class="form-control text-fix">
                                </div>
                                @foreach($categoryProd as $id => $name)
                                    <div class="input-group m-b">
                                        <span class="input-group-addon"><input value="{{$id}}" type="checkbox" class=" check-menu"></span>
                                        <input type="text" value="{{$name}}" class="form-control text-fix">
                                    </div>
                                @endforeach
                            </div>

                                <!-- END Tab - Category Product -->
                        </div>
                    </div>
                </div>
                <div class="ibox-footer">
                    <a id="add_to_menu" class="btn btn-primary" href="#" data-menu="link"> Add to Menu</a>
                </div>
            </div>
        </div>
        @endcan
        <div class="col-sm-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>{!!$heading or ''!!}</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-down"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="dd" id="nestable">
                        <ol class="dd-list">
                            @foreach($menus as $menu)
                            <li class="dd-item" data-id="{!!$menu->id!!}">
                                <div class="dd-handle">
                                    <span class="label label-info"><i class="fa fa-cog"></i></span> 
                                    <img src="{{($menu->image )? route('image.resize',[$menu->image,15,15]) :  asset('assets/backend/img/12.png')}}">
                                    {{$menu->name}}
                                </div>
                                <span class="items-right">
                                    <a href="#modalEdit" data-value="{{json_encode(['id'=>$menu->id, 'name'=>$menu->name, 'image'=>$menu->image, 'link' => $menu->link,'type' => $menu->type])}}" data-toggle="modal" class="btn btn-default btn-xs"><i class="fa fa-pencil"></i></a> 
                                    <a href="{{route('admin.menu.destroy',$menu->id)}}" class="btn btn-danger btn-xs delete-handle"><i class="fa fa-times"></i></a> 
                                </span> 
                                @if(count($menu->children) > 0)
                                    <ol class="dd-list">
                                    @foreach($menu->children as $menu2)
                                        <li class="dd-item" data-id="{{$menu2->id}}">
                                            <div class="dd-handle">
                                                <span class="label label-info"><i class="fa fa-cog"></i></span> {{$menu2->name}}
                                            </div>
                                            <span class="items-right">
                                                <a href="#modalEdit" data-value="{{json_encode(['id'=>$menu2->id, 'name'=>$menu2->name, 'image'=>$menu2->image, 'link' => $menu2->link,'type' => $menu2->type])}}" data-toggle="modal" class="btn btn-default btn-xs"><i class="fa fa-pencil"></i></a> 
                                                <a href="{{route('admin.menu.destroy',$menu2->id)}}" class="btn btn-danger btn-xs delete-handle"><i class="fa fa-times"></i></a> 
                                            </span>
                                            @if (count($menu2->children) > 0)
                                                <ol class="dd-list">
                                                @foreach($menu2->children as $menu3)
                                                    <li class="dd-item" data-id="{{$menu3->id}}">
                                                        <div class="dd-handle">
                                                            <span class="label label-info"><i class="fa fa-cog"></i></span> {{$menu3->name}}
                                                        </div>
                                                        <span class="items-right">
                                                            <a href="#modalEdit" data-value="{{json_encode(['id'=>$menu3->id, 'name'=>$menu3->name, 'image'=>$menu3->image, 'link' => $menu3->link,'type' => $menu3->type])}}" data-toggle="modal" class="btn btn-default btn-xs"><i class="fa fa-pencil"></i></a> 
                                                            <a href="{{route('admin.menu.destroy',$menu3->id)}}" class="btn btn-danger btn-xs delete-handle"><i class="fa fa-times"></i></a> 
                                                        </span>
                                                    </li>
                                                @endforeach
                                                </ol>
                                            @endif
                                        </li>
                                    @endforeach
                                    </ol>
                                @endif
                            </li>
                            @endforeach
                        </ol>
                    </div>

                    <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                {!! Form::open(['url' => '','files'=>true]) !!}
                                <input name="_method" type="hidden" value="PATCH">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Cập nhật</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        {!! Form::label('image','Icon ( 20 x 20 ) px ', ['class'=>'control-label']) !!}
                                        <div class="fileinput fileinput-new" style="width: 100%;" data-provides="fileinput">
                                            <div class="fileinput-preview thumbnail mb20" data-trigger="fileinput" style="width: 50px; height: 50px;">
                                                <img src="">
                                            </div>
                                            <div>
                                                <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Xóa</a>
                                                <div class="btn btn-default btn-file positison-relative">
                                                <span class="fileinput-new">Chọn ảnh</span>
                                                <span class="fileinput-exists">Thay đôi</span>
                                                {!! Form::file('image') !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('name','Tên', ['class'=>'control-label']) !!}
                                        {!! Form::text('name',null, ['class' => 'form-control','required','placeholder'=>'Name']) !!}
                                    </div>
                                    <div class="form-group isLink">
                                        {!! Form::label('link','Link', ['class'=>'control-label']) !!}
                                        {!! Form::text('link',null, ['class' => 'form-control','placeholder'=>'link']) !!}
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    {!! Form::submit('Cập nhật', ['class' => 'btn btn-primary']) !!}
                                </div>
                                {!! Form::close() !!}
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                </div>
                @can('menu-write')
                <div class="ibox-footer">
                    <a class="btn btn-primary save-menu" href="#">Save</a>
                </div>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection

@section ('body-append')
    @parent
    {!! HTML::script('assets/backend/js/plugins/nestable/jquery.nestable.js') !!}       <!-- Flash Message -->  
    {!!HTML::script('assets/backend/js/plugins/form-jasnyupload/fileinput.min.js')!!}
    <script>
        var flash_message = '{!!session("flash_message")!!}';
        var section = '{{$section}}';
        $(function () {

            $('#modalEdit').on('show.bs.modal', function (event) {
                var value = $(event.relatedTarget).data('value')
                var id = value.id;
                var name = value.name;
                var image = (value.image) ? value.image : 'assets/backend/img/no-image.png';
                //console.log(icon);
                var link = value.link;
                var type = value.type;
                if (type == 'link') {
                    $(this).find('.isLink').removeClass('hidden');
                }
                else {
                    $(this).find('.isLink').addClass('hidden');
                } 
                $(this).find('form').attr('action',laroute.route('admin.menu.update',{menu:id}));
                $(this).find('input[name="name"]').val(name);
                $(this).find('.fileinput-preview img').attr('src','/' + image);
                $(this).find('input[name="link"]').val(link);
            });

            $('.group-menu').on('click',function(e){
                $('#add_to_menu').attr('data-menu',$(e.target).data('button'));
                e.preventDefault();
            });

            $('a[data-toggle="tab"][href="#tab-category-product"]').on('shown.bs.tab', function (e) {
                $(".check-all").click(function(){
                    var status=this.checked;
                    $("#tab-category-product .check-menu").each(function(){this.checked=status;})
                });
            });

            $('#add_to_menu').on('click', function(e){
                e.preventDefault();
                var type = $(this).attr('data-menu');
                var valueData = [];
                if (type == 'link') {
                    var nameLink = $('#tab-link').find('input[name="name"]').val().replace(/\ -/g,"");
                    var linkLink = $('#tab-link').find('input[name="link"]').val().replace(/\ -/g,"");

                    valueData.push({"section":section,"type":type,"name":nameLink,"type_id":0,"link":linkLink });
                }
                else {
                    $('#tab-' + type + ' .check-menu').each(function () {
                        if(this.checked){
                            var nameMenu = $(this).parent().siblings('input').val().replace(/\ -/g,"");
                            valueData.push({"section":section,"type":type,"name":nameMenu,"type_id":$(this).val(),"link":''});
                        }
                    });
                }
                $.ajax({ 
                    type: "POST",
                    url: "{!!route('admin.menu.store')!!}",
                    dataType: "json",
                    data: {value: JSON.stringify(valueData)},
                    success: function(results) {
                        var html='';
                        $.each ( results, function(key, item) {
                            html += '<li class="dd-item" data-id="'+item.id+'">'+
                                        '<div class="dd-handle">'+
                                        '<span class="label label-info"><i class="fa fa-cog"></i></span> '+item.name+
                                        '</div>'+
                                        '<span class="items-right">'+
                                            '<a href="'+laroute.route('admin.menu.destroy',{menu:item.id})+'" class="btn btn-danger btn-xs delete-handle"><i class="fa fa-times"></i></a>'+ 
                                        '</span>'+ 
                                    '</li>';
                        });
                        $("#nestable > ol.dd-list").append(html);
                    }
                });
            });
            
            $('#nestable').nestable({
                maxDepth : 3,
                group  : 1
            });

            $(".save-menu").click(function(e){
                e.preventDefault();
                var results = $('#nestable').data('output', $('#nestableMenu-output'));
                var list = results.length ? results : $(e.target);
                if (window.JSON) {
                    var value = window.JSON.stringify(list.nestable('serialize'));
                    $.post(laroute.route('admin.menu.ajax.update'), {value: value}, function (data) {
                        window.location.reload();
                    });
                   
                }
                else {
                    console.log('Lỗi không thể sử dụng tính năng này do trình duyệt của bạn không hỗ trợ JSON.');
                }
            });

            $('.slim-scroll').slimscroll({
                height: 160
            });

            $('.delete-handle').click(function (e) {
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
                     swal("Xóa!", "Bạn đã xóa dữ liệu.", "success");
                    $.post($this.attr('href'), {_method: 'DELETE'}, function (data) {
                        console.log(data);
                        window.location.reload();
                    });
                });
            });
        });
    </script>
@endsection