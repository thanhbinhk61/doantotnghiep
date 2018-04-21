@extends('layouts.backend')

@section('title',isset($heading) ? $heading : '')
@section('head-append')
    @parent
@endsection

@section('page-content')
<div class="wrapper wrapper-content">
	
	<div class="row">
		<div class="col-md-8">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>{!!$heading or ''!!}</h5>
                    <div class="ibox-tools">
                        <a  href="{{route('admin.profile.edit')}}">
                            <i class="fa fa-wrench"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>Name</th>
                                    <td>{{$item->name}}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{$item->email}}</td>
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

		<div class="col-md-4">
            <div class="ibox float-e-margins">        
              <div class="ibox-content profile-content">
                <img width="100%" src="{!!($item->image) ? asset($item->image) : asset('assets/backend/img/user.png')!!}" alt="" class="img-responsive user-avatar">
              </div>
            </div><!-- panel -->
        </div>
	</div>
</div>

@endsection
@section ('body-append')
	@parent
	<script>
		var flash_message = '{!!session("flash_message")!!}';
	</script>
@endsection