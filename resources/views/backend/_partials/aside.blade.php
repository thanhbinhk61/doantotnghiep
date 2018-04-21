<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{$me->name}}</strong>
                         </span> <span class="text-muted text-xs block">{{$me->email}} <b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="{{route('admin.profile')}}">Profile</a></li>
                        <li><a href="{{route('admin.profile.edit')}}">Settings</a></li>
                        <li class="divider"></li>
                        <li><a href="/logout">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    
                </div>
            </li>
            <li @if(Request::is('admin')) class="active" @endif>
                <a href="/admin"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboards</span></a>
            </li>
            <li @if (Request::is('admin/post*') || Request::is('admin/category/type/post')) class="active" @endif>
                <a href="#"><i class="fa fa-newspaper-o"></i> <span class="nav-label">{{trans('repositories.post')}}</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    @can('post-read')
                    <li><a href="{{route('admin.post.index')}}">danh sách {{trans('repositories.post')}}</a></li>
                    @endcan
                    @can ('category-read')
                    <li><a href="{!!route('admin.category.type','post')!!}">{{trans('repositories.category')}}</a></li>
                    @endcan
                </ul>
            </li>
            @can('page-read')
             <li @if(Request::is('admin/page*')) class="active" @endif>
                <a href="{{route('admin.page.index')}}"><i class="fa fa-file-o"></i> <span class="nav-label">{{trans('repositories.page')}}</span></a>
            </li>
            @endcan
            @can('order-read')
             <li @if (Request::is('admin/order*') || Request::is('admin/ship*')) class="active" @endif>
                <a href="#"><i class="fa fa-shopping-cart"></i> <span class="nav-label">{{trans('repositories.order')}}</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li @if(Request::is('admin/order*')) class="active" @endif><a href="{{route('admin.order.index')}}">{{trans('repositories.order')}}</a></li>
                    <li @if(Request::is('admin/ship*')) class="active" @endif><a href="{{route('admin.ship.index')}}">{{trans('repositories.ship')}}</a></li>
                </ul>
            </li>
            @endcan
            <li @if (Request::is('admin/product*') || Request::is('admin/property*') || Request::is('admin/provider*') || Request::is('admin/category/type/product')) class="active" @endif>
                <a href="#"><i class="fa fa-folder-o"></i> <span class="nav-label">{{trans('repositories.product')}}</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    @can('product-read')
                    <li ><a href="{{route('admin.product.index')}}">danh sách {{trans('repositories.product')}}</a></li>
                    @endcan
                    @can ('category-read')
                    <li><a href="{!!route('admin.category.type','product')!!}">{{trans('repositories.category')}}</a></li>
                    @endcan
                    @can('property-read')
                    <li><a href="{!!route('admin.property.index')!!}">{{trans('repositories.property')}}</a></li>
                    @endcan
                    @can('provider-read')
                    <li><a href="{!!route('admin.provider.index')!!}">{{trans('repositories.provider')}}</a></li>
                    @endcan
                </ul>
            </li>
            <li @if(Request::is('admin/slide*')) class="active" @endif>
                @can('slide-read')
                <a href="{{route('admin.slide.index')}}"><i class="fa fa-file-movie-o"></i> <span class="nav-label">{{trans('repositories.slide')}}</span></a>
                @endcan
            </li>
            <li @if(Request::is('admin/menu*')) class="active" @endif>
                @can('menu-read')
                <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Menu</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li @if(Request::is('admin/menu/section/head')) class="active" @endif><a href="{{route('admin.menu.section','head')}}">Menu Head</a></li>
                    <li @if(Request::is('admin/menu/section/left')) class="active" @endif><a href="{{route('admin.menu.section','left')}}">Menu Trái</a></li>
                    <li @if(Request::is('admin/menu/section/footer')) class="active" @endif><a href="{{route('admin.menu.section','footer')}}">Menu footer</a></li>
                </ul>
                @endcan
            </li>
            <li @if (Request::is('admin/customer*') || Request::is('admin/register*')) class="active" @endif>
                @can('customer-read')
                <a href="#"><i class="fa fa-users"></i> <span class="nav-label">{{trans('repositories.customer')}}</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li @if(Request::is('admin/customer')) class="active" @endif><a href="{{route('admin.customer.index')}}">{{trans('repositories.customer')}}</a></li>
                    <li @if(Request::is('admin/customer/provider')) class="active" @endif><a href="{{route('admin.customer.provider')}}">{{trans('repositories.provider')}}</a></li>
                    <li @if(Request::is('admin/register*')) class="active" @endif><a href="{{route('admin.register.index')}}">{{trans('repositories.register')}}</a></li>
                </ul>
                @endcan
            </li>
            <li @if(Request::is('admin/contact*')) class="active" @endif>
                <a href="{{route('admin.contact.index')}}"><i class="fa fa-credit-card"></i> <span class="nav-label">{{trans('repositories.contact')}}</span></a>
            </li>
            <li @if(Request::is('admin/user*') || Request::is('admin/config*') || Request::is('admin/expense*') || Request::is('admin/coupon*') || Request::is('admin/role*')) class="active" @endif>
                <a href="#"><i class="fa fa-cogs"></i> <span class="nav-label">{{trans('repositories.config')}}</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    @can('user-read')
                    <li><a href="{{route('admin.user.index')}}">{{trans('repositories.user')}}</a></li>
                    @endcan
                    @can('role-read')
                    <li><a href="{{route('admin.role.index')}}">{{trans('repositories.role')}}</a></li>
                    @endcan
                    @can('expense-read')
                    <li><a href="{{route('admin.expense.index')}}">{{trans('repositories.expense')}}</a></li>
                    @endcan
                    @can('coupon-read')
                    <li><a href="{{route('admin.coupon.index')}}">{{trans('repositories.coupon')}}</a></li>
                    @endcan
                    @can('config-read')
                    <li><a href="{{route('admin.config.index')}}">Cấu hình chung</a></li>
                    @endcan
                </ul>
            </li>
        </ul>

    </div>
</nav>
