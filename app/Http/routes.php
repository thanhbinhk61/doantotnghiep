<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/


Route::group(['middlewareGroups' => ['web']], function () {
    Route::auth();
    Route::get('auth/social/{social}',['as' => 'auth.social', 'uses' => 'Frontend\AuthController@getSocial']);
    Route::get('auth/social/callback/{social}', 'Frontend\AuthController@handleCallback');
    Route::get('image-resize/{file}/{w?}/{h?}', ['as' => 'image.resize', 'uses' => 'Backend\DashboardController@resize'])->where(['file' => '(.*?)']);
    Route::get('/', 'Frontend\HomeController@index');

    // Route::get('test-send-mail', function () {
    //     app(\App\Services\Contracts\MailService::class)->send(['name'=>'email'], ['dung13890@gmail.com'], 'order', 'co don hang moi');
    // });

    Route::get('a-{slug}.html', ['as'=>'post.show', 'uses'=>'Frontend\PostController@show']);
    Route::get('ca-{slug}.html', ['as'=>'post.category', 'uses'=>'Frontend\PostController@category']);
    Route::get('p-{slug}.html', ['as'=>'product.show', 'uses'=>'Frontend\ProductController@show']);
    Route::post('product/ajax/quickview',['as'=>'product.ajax.quickview', 'uses'=> 'Frontend\ProductController@ajaxQuickview']);
    Route::get('cp-{slug}.html/{range?}/{colors?}/{brands?}', ['as'=>'product.category', 'uses'=>'Frontend\ProductController@category']);
    Route::post('product/cart/store/{id}',['as'=>'product.cart.store', 'uses'=> 'Frontend\ProductController@cartStore']);
    Route::post('product/cart/update',['as'=>'product.cart.update', 'uses'=> 'Frontend\ProductController@cartUpdate']);
    Route::post('product/cart/checkout',['as'=>'product.cart.checkout', 'uses'=> 'Frontend\ProductController@cartCheckout']);
    Route::get('product/cart/delete/{id}',['as'=>'product.cart.delete', 'uses'=> 'Frontend\ProductController@cartDelete']);
    Route::post('product/comment/store',['as'=>'product.comment.store', 'uses'=> 'Frontend\ProductController@postComment']);
    Route::get('tim-kiem-san-pham',['as'=>'product.search', 'uses'=> 'Frontend\ProductController@search']);
    Route::post('product/ajax/search',['as'=>'product.ajax.search', 'uses'=> 'Frontend\ProductController@ajaxSearch']);
    
    Route::get('gio-hang.html', ['as'=>'product.cart', 'uses'=>'Frontend\ProductController@cart']);
    Route::get('gio-hang-guest.html', ['as'=>'order.guest', 'uses'=>'Frontend\OrderController@guest']);
    Route::post('order/find/post',['as'=>'order.find.post', 'uses'=> 'Frontend\OrderController@postFind']);
    Route::post('order/ajax/customer/address/{address}',['as'=>'order.ajax.customer.address', 'uses'=> 'Frontend\OrderController@ajaxCustomerAddress']);
    Route::post('order/ajax/expense',['as'=>'order.ajax.expense', 'uses'=> 'Frontend\OrderController@ajaxExpense']);
    Route::post('order/guest/checkout',['as'=>'order.guest.checkout', 'uses'=> 'Frontend\OrderController@guestCheckout']);
    Route::post('order/payment/store',['as'=>'order.payment.store', 'uses'=> 'Frontend\OrderController@paymentStore']);
    Route::post('order/ajax/coupon/{coupon}',['as'=>'order.ajax.coupon', 'uses'=> 'Frontend\OrderController@ajaxCoupon']);
    Route::PATCH('order/update/guest/{order}', ['as'=>'order.update.guest', 'uses'=>'Frontend\OrderController@updateGuest']);
    Route::get('gio-hang-info.html', ['as'=>'order.info', 'uses'=>'Frontend\OrderController@info']);
    Route::get('order/payment/success',['as'=>'order.payment.success', 'uses'=> 'Frontend\OrderController@paymentSuccess']);

    Route::get('nha-cung-cap/{slug}/{range?}/{colors?}/{brands?}', ['as'=>'product.provider', 'uses'=>'Frontend\ProviderController@getProduct']);
    Route::get('nha-cung-cap', ['as'=>'provider.index', 'uses'=>'Frontend\ProviderController@index']);
    Route::get('thuong-hieu/{id}', ['as'=>'brand.product', 'uses'=>'Frontend\BrandController@product']);
    Route::get('thuong-hieu', ['as'=>'brand.index', 'uses'=>'Frontend\BrandController@index']);

    Route::post('wish-list/{id}', ['as'=>'customer.wishlist.add', 'uses'=>'Frontend\CustomerController@addWishList']);
    Route::DELETE('wish-list/destroy/{id}', ['as'=>'customer.wishlist.destroy', 'uses'=>'Frontend\CustomerController@deleteWishlist']);
    Route::get('khach-hang.html', ['as'=>'customer.index', 'uses'=>'Frontend\CustomerController@index']);
    Route::post('customer/card/post', ['as'=>'customer.card.post', 'uses'=>'Frontend\CustomerController@postCard']);
    Route::get('khach-hang/thong-tin-thanh-toan.html', ['as'=>'customer.card', 'uses'=>'Frontend\CustomerController@card']);
    Route::get('khach-hang/danh-sach-yeu-thich.html', ['as'=>'customer.wishlist', 'uses'=>'Frontend\CustomerController@wishList']);
    Route::post('home/ship/post', ['as'=>'ship.post', 'uses'=>'Frontend\HomeController@postShip']);
    Route::get('dat-hang-order.html', ['as'=>'order.ship', 'uses'=>'Frontend\HomeController@getShip']);
    Route::get('khach-hang/don-hang.html', ['as'=>'customer.order', 'uses'=>'Frontend\CustomerController@order']);
    Route::get('khach-hang/chi-tiet-don-hang-{id}.html/{print?}', ['as'=>'customer.order.show', 'uses'=>'Frontend\CustomerController@showOrder']);
    Route::get('khach-hang/thong-ke-doanh-thu-san-pham.html', ['as'=>'customer.provider.statistic', 'uses'=>'Frontend\CustomerController@providerStatistic']);
    Route::post('customer/update', ['as'=>'customer.update', 'uses'=>'Frontend\CustomerController@update']);
    Route::DELETE('customer/address/destroy/{address}', ['as'=>'customer.address.destroy', 'uses'=>'Frontend\CustomerController@deleteAddress']);
    Route::DELETE('customer/card/destroy/{card}', ['as'=>'customer.card.destroy', 'uses'=>'Frontend\CustomerController@deleteCard']);
    Route::post('customer/address/store', ['as'=>'customer.address.post', 'uses'=>'Frontend\CustomerController@postAddress']);

    Route::get('dang-ky/dang-ky-gian-hang.html', ['as'=>'home.register', 'uses'=>'Frontend\HomeController@register']);
    Route::post('dang-ky/dang-ky-gian-hang.html', ['as'=>'home.register.post', 'uses'=>'Frontend\HomeController@postRegister']);
    Route::get('dang-nhap', ['as'=>'auth.login', 'uses'=>'Frontend\AuthController@getLogin']);
    Route::get('quen-mat-khau', ['as'=>'auth.reset.password', 'uses'=>'Frontend\PasswordController@getEmail']);
    Route::post('lay-mat-khau', ['as'=>'auth.send.password.email', 'uses'=>'Frontend\PasswordController@sendResetLinkEmail']);
    //Route::post('thay-doi-mat-khau', ['as'=>'auth.emails.password', 'uses'=>'Frontend\PasswordController@sendResetLinkEmail']);
    Route::get('thoat', ['as'=>'auth.logout', 'uses'=>'Frontend\AuthController@getLogout']);
    Route::post('dang-nhap', 'Frontend\AuthController@login');
    Route::get('dang-ky', ['as'=>'auth.register', 'uses'=>'Frontend\AuthController@getRegister']);
    Route::post('dang-ky', ['as'=>'auth.store', 'uses'=>'Frontend\AuthController@store']);
    Route::get('trang/{slug}.html', ['as'=>'page.show', 'uses'=>'Frontend\HomeController@page']);
    Route::post('contact.html', ['as'=>'contact.store', 'uses'=>'Frontend\HomeController@postContact']);

    Route::group(['prefix' => '/admin', 'namespace' => 'Backend','middleware' => ['auth']], function () {
		Route::get('/', 'DashboardController@index');
		Route::DELETE('/comment/destroy/{id}',['as'=>'admin.comment.destroy','uses'=>'DashboardController@deleteComment']);
		Route::POST('/comment/edit/{id}',['as'=>'admin.comment.edit','uses'=>'DashboardController@editComment']);
        Route::post('image/ajax',['as'=>'admin.image.ajax', 'uses'=> 'DashboardController@uploadImage']);
		Route::PATCH('notification/{notification}',['as'=>'admin.notification.update', 'uses'=> 'DashboardController@updateNotification']);
		
		Route::get('user/data', ['as'=>'admin.user.data', 'uses'=>'UserController@getData']);
		Route::get('user/data/role/{role}', ['as'=>'admin.user.data.role', 'uses'=>'UserController@getDataWithRole']);
        Route::get('user/role/{role}', ['as'=>'admin.user.role', 'uses'=>'UserController@role']);
        Route::resource('user', 'UserController');

        Route::get('role/data', ['as'=>'admin.role.data', 'uses'=>'RoleController@getData']);
        Route::resource('role', 'RoleController');

		Route::get('profile', ['as'=>'admin.profile', 'uses'=>'ProfileController@userShow']);
		Route::get('profile/edit', ['as'=>'admin.profile.edit', 'uses'=>'ProfileController@userEdit']);
		Route::post('profile/update', ['as'=>'admin.profile.update', 'uses'=>'ProfileController@userUpdate']);

		Route::get('category/type/{type}', ['as'=>'admin.category.type', 'uses'=>'CategoryController@getDataWithType']);
		Route::post('category/ajaxParent', ['as'=>'admin.category.ajax.parent', 'uses'=>'CategoryController@ajaxParent']);
		Route::post('category/upload/image', ['as'=>'admin.category.upload.image', 'uses'=>'CategoryController@uploadImage']);
		Route::resource('category', 'CategoryController');

		Route::get('post/data', ['as'=>'admin.post.data', 'uses'=>'PostController@getData']);
		Route::get('post/data/category/{category}', ['as'=>'admin.post.data.category', 'uses'=>'PostController@getDataWithCategory']);
		Route::get('post/category/{category}', ['as'=>'admin.post.category', 'uses'=>'PostController@category']);
		Route::resource('post', 'PostController');

		Route::get('product/data', ['as'=>'admin.product.data', 'uses'=>'ProductController@getData']);
		Route::get('product/data/category/{category}', ['as'=>'admin.product.data.category', 'uses'=>'ProductController@getDataWithCategory']);
		Route::get('product/category/{category}', ['as'=>'admin.product.category', 'uses'=>'ProductController@category']);
		Route::post('product/upload/image', ['as'=>'admin.product.upload.image', 'uses'=>'ProductController@uploadImage']);
		Route::resource('product', 'ProductController');

		Route::get('config', ['as'=>'admin.config.index', 'uses'=>'ConfigController@index']);
		Route::Patch('config/{id}', ['as'=>'admin.config.update', 'uses'=>'ConfigController@update']);

		Route::get('order/data', ['as'=>'admin.order.data', 'uses'=>'OrderController@getData']);
		Route::resource('order', 'OrderController');

        Route::get('ship/data', ['as'=>'admin.ship.data', 'uses'=>'ShipController@getData']);
        Route::resource('ship', 'ShipController');

        Route::get('register/data', ['as'=>'admin.register.data', 'uses'=>'RegisterController@getData']);
        Route::resource('register', 'RegisterController');

		Route::get('page/data', ['as'=>'admin.page.data', 'uses'=>'PageController@getData']);
		Route::resource('page', 'PageController');

		Route::get('expense/data', ['as'=>'admin.expense.data', 'uses'=>'ExpenseController@getData']);
		Route::resource('expense', 'ExpenseController');

		Route::DELETE('coupon/code/destroy/{id}', ['as'=>'admin.coupon.code.destroy', 'uses'=>'CouponController@deleteCode']);
		Route::get('coupon/data', ['as'=>'admin.coupon.data', 'uses'=>'CouponController@getData']);
		Route::resource('coupon', 'CouponController');

		Route::get('property/data', ['as'=>'admin.property.data', 'uses'=>'PropertyController@getData']);
		Route::get('property/data/type/{type}', ['as'=>'admin.property.data.type', 'uses'=>'PropertyController@getDataWithType']);
		Route::get('property/type/{type}', ['as'=>'admin.property.type', 'uses'=>'PropertyController@type']);
		Route::resource('property', 'PropertyController');

		Route::get('provider/data', ['as'=>'admin.provider.data', 'uses'=>'ProviderController@getData']);
		Route::resource('provider', 'ProviderController');

		Route::get('menu/section/{section}', ['as'=>'admin.menu.section', 'uses'=>'MenuController@getDataWithSection']);
		Route::post('menu/ajax-update', ['as'=>'admin.menu.ajax.update', 'uses'=>'MenuController@ajaxUpdate']);
		Route::resource('menu', 'MenuController');

		Route::get('slide/data', ['as'=>'admin.slide.data', 'uses'=>'SlideController@getData']);
		Route::resource('slide', 'SlideController');

        Route::DELETE('customer/address/destroy/{id}', ['as'=>'admin.customer.address.destroy', 'uses'=>'CustomerController@deleteAddress']);
        Route::DELETE('customer/card/destroy/{id}', ['as'=>'admin.customer.card.destroy', 'uses'=>'CustomerController@deleteCard']);
        Route::get('customer/provider/data', ['as'=>'admin.customer.provider.data', 'uses'=>'CustomerController@getDataProvider']);
        Route::get('customer/provider', ['as'=>'admin.customer.provider', 'uses'=>'CustomerController@provider']);
        Route::get('customer/data', ['as'=>'admin.customer.data', 'uses'=>'CustomerController@getData']);
        Route::get('customer/provider/create', ['as'=>'admin.customer.provider.create', 'uses'=>'CustomerController@createProvider']);
        Route::post('customer/provider/store', ['as'=>'admin.customer.provider.store', 'uses'=>'CustomerController@storeProvider']);
        Route::get('customer/data/order/{id}', ['as'=>'admin.customer.data.order', 'uses'=>'CustomerController@getDataOrder']);
        Route::resource('customer', 'CustomerController');

		Route::get('contact/data', ['as'=>'admin.contact.data', 'uses'=>'ContactController@getData']);
		Route::resource('contact', 'ContactController');

	});
});
