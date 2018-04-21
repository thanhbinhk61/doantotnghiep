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
        <div class="table-responsive">
            <table class="table">
                <tbody>
                    <tr>
                        <th>Name</th>
                        <td>{{ $item->name}}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $item->email}}</td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>{{ $item->phone}}</td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>{{ $item->store_show}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="ibox-content">
        <div class="table-responsive">
            <table class="table">
                <tbody>
                    <tr>
                        <th>Tên giấy phép</th>
                        <td>{{ $item->company_name}}</td>
                    </tr>
                    <tr>
                        <th>Loại hình công ty</th>
                        <td>{{ config("umzila.registerProvider.companyType.{$item->company_type}")}}</td>
                    </tr>
                    <tr>
                        <th>Thành phố</th>
                        <td>{{ $item->city}}</td>
                    </tr>
                    <tr>
                        <th>Quận/ Huyện</th>
                        <td>{{ $item->district}}</td>
                    </tr>

                    <tr>
                        <th>Địa chỉ</th>
                        <td>{{ $item->address}}</td>
                    </tr>
                    <tr>
                        <th>Người liên hệ</th>
                        <td>{{$item->contact}}</td>
                    </tr>
                    <tr>
                        <th>Số đăng ký kinh doanh</th>
                        <td>{{$item->number_register}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="ibox-content">
        <div class="table-responsive">
            <table class="table">
                <tbody>
                    <tr>
                        <th>Nhãn hiệu đang bán</th>
                        <td>{{ $item->brand}}</td>
                    </tr>
                    <tr>
                        <th>Ngành hàng/dịch vụ</th>
                        <td>
                            {{
                                (config("umzila.registerProvider.categories.{$item->category_id}")) ? config("umzila.registerProvider.categories.{$item->category_id}") :
                                    config("umzila.registerProvider.services.{$item->category_id}")
                            }}
                        </td>
                    </tr>
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