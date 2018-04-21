<div class="block left-module">
    <p class="title_block">Tài khoản của bạn</p>
    <div class="block_content">
        <!-- layered -->
        <div class="layered layered-category">
            <div class="layered-content">
                <ul class="tree-menu">
                    <li @if (route('customer.index') === Request::url()) class="active" @endif)><span></span> <a href="{{route('customer.index')}}">Thông tin cá nhân </a></li>
                    <li @if (route('customer.order') === Request::url()) class="active" @endif><span></span> <a href="{{route('customer.order')}}">Đơn hàng của tôi </a></li>
                    <li @if (route('customer.wishlist') === Request::url()) class="active" @endif)><span></span> <a href="{{route('customer.wishlist')}}">Danh sách yêu thích</a></li>
                    <li @if (route('customer.card') === Request::url()) class="active" @endif)><span></span> <a href="{{route('customer.card')}}">Thông tin thanh toán</a></li>
                    @if ($me->provider_id)
                    <li @if (route('customer.provider.statistic') === Request::url()) class="active" @endif)><span></span> <a href="{{route('customer.provider.statistic')}}">Thống kê sản phẩm</a></li>
                    @endif
                </ul>
            </div>
        </div>
        <!-- ./layered -->
    </div>
</div>
