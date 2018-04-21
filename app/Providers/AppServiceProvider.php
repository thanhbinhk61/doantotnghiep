<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cache;
use App\Repositories\Contracts\ConfigRepository;
use App\Repositories\Contracts\MenuRepository;
use App\Repositories\Contracts\CategoryRepository;
use App\Repositories\Contracts\ProductRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \App\Repositories\Contracts\UserRepository::class,
            \App\Repositories\UserRepositoryEloquent::class
        );
        $this->app->bind(
            \App\Repositories\Contracts\CategoryRepository::class,
            \App\Repositories\CategoryRepositoryEloquent::class
        );
        $this->app->bind(
            \App\Repositories\Contracts\PostRepository::class,
            \App\Repositories\PostRepositoryEloquent::class
        );
        $this->app->bind(
            \App\Repositories\Contracts\PageRepository::class,
            \App\Repositories\PageRepositoryEloquent::class
        );
        $this->app->bind(
            \App\Repositories\Contracts\SlideRepository::class,
            \App\Repositories\SlideRepositoryEloquent::class
        );
        $this->app->bind(
            \App\Repositories\Contracts\ProductRepository::class,
            \App\Repositories\ProductRepositoryEloquent::class
        );
        $this->app->bind(
            \App\Repositories\Contracts\PropertyRepository::class,
            \App\Repositories\PropertyRepositoryEloquent::class
        );
        $this->app->bind(
            \App\Repositories\Contracts\ConfigRepository::class,
            \App\Repositories\ConfigRepositoryEloquent::class
        );
        $this->app->bind(
            \App\Repositories\Contracts\MenuRepository::class,
            \App\Repositories\MenuRepositoryEloquent::class
        );
        $this->app->bind(
            \App\Repositories\Contracts\OrderRepository::class,
            \App\Repositories\OrderRepositoryEloquent::class
        );
        $this->app->bind(
            \App\Repositories\Contracts\ProviderRepository::class,
            \App\Repositories\ProviderRepositoryEloquent::class
        );
        $this->app->bind(
            \App\Repositories\Contracts\CommentRepository::class,
            \App\Repositories\CommentRepositoryEloquent::class
        );
        $this->app->bind(
            \App\Repositories\Contracts\ContactRepository::class,
            \App\Repositories\ContactRepositoryEloquent::class
        );
        $this->app->bind(
            \App\Repositories\Contracts\ExpenseRepository::class,
            \App\Repositories\ExpenseRepositoryEloquent::class
        );
        $this->app->bind(
            \App\Repositories\Contracts\CustomerRepository::class,
            \App\Repositories\CustomerRepositoryEloquent::class
        );
        $this->app->bind(
            \App\Repositories\Contracts\CouponRepository::class,
            \App\Repositories\CouponRepositoryEloquent::class
        );
        $this->app->bind(
            \App\Repositories\Contracts\ShipRepository::class,
            \App\Repositories\ShipRepositoryEloquent::class
        );
        $this->app->bind(
            \App\Repositories\Contracts\RegisterRepository::class,
            \App\Repositories\RegisterRepositoryEloquent::class
        );


        $this->app->bind(
            \App\Services\Contracts\UploadService::class,
            \App\Services\UploadServiceJob::class
        );
        $this->app->bind(
            \App\Services\Contracts\UserService::class,
            \App\Services\UserServiceJob::class
        );
        $this->app->bind(
            \App\Services\Contracts\RoleService::class,
            \App\Services\RoleServiceJob::class
        );
        $this->app->bind(
            \App\Services\Contracts\CategoryService::class,
            \App\Services\CategoryServiceJob::class
        );
        $this->app->bind(
            \App\Services\Contracts\PostService::class,
            \App\Services\PostServiceJob::class
        );
        $this->app->bind(
            \App\Services\Contracts\PageService::class,
            \App\Services\PageServiceJob::class
        );
        $this->app->bind(
            \App\Services\Contracts\SlideService::class,
            \App\Services\SlideServiceJob::class
        );
        $this->app->bind(
            \App\Services\Contracts\ProductService::class,
            \App\Services\ProductServiceJob::class
        );
        $this->app->bind(
            \App\Services\Contracts\PropertyService::class,
            \App\Services\PropertyServiceJob::class
        );
        $this->app->bind(
            \App\Services\Contracts\ConfigService::class,
            \App\Services\ConfigServiceJob::class
        );
        $this->app->bind(
            \App\Services\Contracts\MenuService::class,
            \App\Services\MenuServiceJob::class
        );
        $this->app->bind(
            \App\Services\Contracts\OrderService::class,
            \App\Services\OrderServiceJob::class
        );
        $this->app->bind(
            \App\Services\Contracts\MailService::class,
            \App\Services\MailServiceJob::class
        );
        $this->app->bind(
            \App\Services\Contracts\ProviderService::class,
            \App\Services\ProviderServiceJob::class
        );
        $this->app->bind(
            \App\Services\Contracts\CommentService::class,
            \App\Services\CommentServiceJob::class
        );
        $this->app->bind(
            \App\Services\Contracts\ContactService::class,
            \App\Services\ContactServiceJob::class
        );
        $this->app->bind(
            \App\Services\Contracts\ExpenseService::class,
            \App\Services\ExpenseServiceJob::class
        );
        $this->app->bind(
            \App\Services\Contracts\CustomerService::class,
            \App\Services\CustomerServiceJob::class
        );
        $this->app->bind(
            \App\Services\Contracts\CouponService::class,
            \App\Services\CouponServiceJob::class
        );
        $this->app->bind(
            \App\Services\Contracts\ShipService::class,
            \App\Services\ShipServiceJob::class
        );
        $this->app->bind(
            \App\Services\Contracts\RegisterService::class,
            \App\Services\RegisterServiceJob::class
        );

        $this->composers();
    }

    public function composers()
    {
        view()->composer('backend.*', function ($view) {
            $view->with('me', \Auth::user());
        });

        view()->composer('frontend.*', function ($view) {
            $view->with('me', \Auth::guard('frontend')->user());
            $view->with('configs', Cache::remember('configs', 60, function () {
                return app(ConfigRepository::class)->all()->first();
            }));
            $view->with('menuHead', Cache::remember('menuHead', 60, function () {
                return app(MenuRepository::class)->root('head');
            }));

            $view->with('menuLeft', Cache::remember('menuLeft', 60, function () {
                return app(MenuRepository::class)->root('left');
            }));

            $view->with('menuFooter', Cache::remember('menuFooter', 60, function () {
                return app(MenuRepository::class)->root('footer');
            }));

            $view->with('categoryPost', Cache::remember('categoryPost', 60, function () {
                return app(CategoryRepository::class)->postHome(5);
            }));

            $view->with('categoryList', Cache::remember('categoryList', 60, function () {
                return app(CategoryRepository::class)->products()->lists('name','id')->prepend('Tất cả danh mục','0');
            }));

            // $view->with('categoryProperty', Cache::remember('categoryProperty', 60, function () {
            //     return app(CategoryRepository::class)->properties();
            // }));

            $view->with('categoryRoots', Cache::remember('categoryRoots', 60, function () {
                return app(CategoryRepository::class)->rootWithType('product');
            }));
        });

        view()->composer(['frontend.product.*','frontend.order.*','frontend.post.*','frontend.provider.*','frontend.brand.*','frontend.home.page','frontend.home.order_ship'], function ($view) {
            $view->with('productRandom', Cache::remember('productRandom', 60, function () {
                return app(ProductRepository::class)->random(8);
            }));
            $view->with('productSaleRandom', app(ProductRepository::class)->onSale(3));
        });
    }
}
