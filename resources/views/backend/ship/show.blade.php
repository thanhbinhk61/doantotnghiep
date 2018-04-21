@extends('layouts.backend')
@section('title',isset($heading) ? $heading : '')

@section('head-append')
    @parent
    {!!HTML::style('assets/backend/js/plugins/summernote/dist/summernote.css')!!}
@endsection

@section('page-content')
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-md-7">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Link đặt hàng</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-down"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <th>STT</th>
                                    <th>Link</th>
                                    <th>Ghi chú</th>
                                </thead>
                                <tbody>
                                    @if ($item->info)
                                    <?php $count = 1;?>
                                    @foreach (json_decode($item->info) as $infoJson)
                                    <tr>
                                        <td>{{$count++}}</td>
                                        <td><a target="_blank" href="{{$infoJson->link}}">Link</a></td>
                                        <th>{{$infoJson->description}}</th>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>{!!$heading or ''!!}</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Name</th>
                                        <td>{{ ($item->customer_id == 0) ? $item->name : $item->customer->name}}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ ($item->customer_id == 0) ? $item->email : $item->customer->email}}</td>
                                    </tr>
                                    <tr>
                                        <th>Phone</th>
                                        <td>{{ ($item->customer_id == 0) ? $item->phone : $item->customer->phone}}</td>
                                    </tr>
                                    <tr>
                                        <th>Address</th>
                                        <td>{{ ($item->customer_id == 0) ? $item->address : $item->customer->address}}</td>
                                    </tr>
                                    @if ($item->customer)
                                    <tr>
                                        <th>Khách hàng</th>
                                        <td>@if ($item->customer->category) <span class="label label-primary"> {{ $item->customer->category->name}} </span> @endif</td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <th>Note</th>
                                        <td>{{ $item->note}}</td>
                                    </tr>
                                    <tr>
                                        <th>Ngày tạo</th>
                                        <td>{{$item->created_at}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::model($item, ['method' => 'PATCH', 'url' => route('admin.ship.update', $item->id) , 'class' => 'form-horizontal']) !!}
            <div class="col-md-5">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>{!!$heading or 'Thêm mới'!!}</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-down"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        
                        <div class="form-group">
                            {!! Form::label('total','Báo giá', ['class'=>'col-sm-2 control-label']) !!}
                            <div class="col-sm-8">
                            {!! Form::text('total',null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('reply','Trả lời', ['class'=>'col-sm-2 control-label']) !!}
                            <div class="col-sm-8">
                            {!! Form::textarea('reply',null, ['class' => 'form-control textarea-summernote']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('status','Trạng  thái', ['class'=>'col-sm-2 control-label']) !!}
                            <div class="col-sm-8">
                                {!! Form::select('status', $orderStatus , null, ['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="checkbox col-sm-8 col-sm-offset-2">
                                <label>
                                    <input name="sendmail" type="checkbox" checked value="1"> Gửi mail thông báo cho khách hàng
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-8 col-sm-offset-2">
                                {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
                                {!! Form::reset('Cancel', ['class' => 'btn btn-default']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {!!Form::close()!!}
        </div>
    </div>

@endsection

@section('body-append')
    @parent
    {!!HTML::script('assets/backend/js/plugins/summernote/dist/summernote.min.js')!!}
    <script>
        $(function(){

            $('.textarea-summernote').summernote({
              height:250,
              toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['misc', ['undo', 'redo']]
            ],
            });
        });
    </script>

@endsection
