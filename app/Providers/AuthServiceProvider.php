<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        \App\Eloquent\User::class => \App\Policies\UserPolicy::class,
        \Silber\Bouncer\Database\Role::class => \App\Policies\RolePolicy::class,
        \App\Eloquent\Category::class => \App\Policies\CategoryPolicy::class,
        \App\Eloquent\Post::class => \App\Policies\PostPolicy::class,
        \App\Eloquent\Product::class => \App\Policies\ProductPolicy::class,
        \App\Eloquent\Property::class => \App\Policies\PropertyPolicy::class,
        \App\Eloquent\Provider::class => \App\Policies\ProviderPolicy::class,
        \App\Eloquent\Slide::class => \App\Policies\SlidePolicy::class,
        \App\Eloquent\Menu::class => \App\Policies\MenuPolicy::class,
        \App\Eloquent\Customer::class => \App\Policies\CustomerPolicy::class,
        \App\Eloquent\Expense::class => \App\Policies\ExpensePolicy::class,
        \App\Eloquent\Page::class => \App\Policies\PagePolicy::class,
        \App\Eloquent\Coupon::class => \App\Policies\CouponPolicy::class,
        \App\Eloquent\Config::class => \App\Policies\ConfigPolicy::class,
        \App\Eloquent\Order::class => \App\Policies\OrderPolicy::class,
        \App\Eloquent\Contact::class => \App\Policies\ContactPolicy::class,
        \App\Eloquent\Ship::class => \App\Policies\ShipPolicy::class,
        \App\Eloquent\Register::class => \App\Policies\StorePolicy::class,
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        //
    }
}
