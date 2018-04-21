@extends('layouts.backend')
@section('title',isset($heading) ? $heading : '')

@section('page-content')
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-md-8">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>{!!$heading or ''!!}</h5>
                        <div class="ibox-tools">
                            <a  href="{{route('admin.category.edit',$item->id)}}">
                                <i class="fa fa-wrench"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table">
								<tbody>
									<tr>
										<th>Tiêu đề</th>
										<td>{!!$item->name!!}</td>
									</tr>
									<tr>
										<th>Mô tả</th>
										<td>{!!$item->description!!}</td>
									</tr>
									@if ($item->parent)
									<tr>
										<th>Danh mục cha</th>
										<td>{!!$item->parent->name!!}</td>
									</tr>
									@endif
									<tr>
										<th>Icon</th>
										<td><i class="fa {{$item->icon_fa}}"></i></td>
									</tr>
									<tr>
										<th>Created_at</th>
										<td>{!!$item->created_at!!}</td>
									</tr>
								</tbody>
							</table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
