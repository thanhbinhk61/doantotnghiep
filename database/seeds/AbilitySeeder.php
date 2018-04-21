<?php

use App\Eloquent\User;
use Illuminate\Database\Seeder;

class AbilitySeeder extends Seeder
{
    public function run()
    {
        $abilities = array(
            'role-read', 'role-write',
            'user-read', 'user-write',
            'post-read', 'post-write',
            'page-read', 'page-write',
            'category-read', 'category-write',
            'product-read', 'product-write',
            'slide-read', 'slide-write',
            'config-read', 'config-write',
            'coupon-read', 'coupon-write',
            'customer-read', 'customer-write',
            'expense-read', 'expense-write',
            'menu-read', 'menu-write',
            'order-read', 'order-write',
            'property-read', 'property-write',
            'provider-read', 'provider-write',
        );

        foreach ($abilities as $ability) {
            Bouncer::ability(['name' => $ability])->save();
        }
        Bouncer::allow('system')->to($abilities);
        Bouncer::allow('admin')->to($abilities);
        Bouncer::allow('product_manager')->to([
                            'category-write','category-read',
                            'product-read','product-write',
                            'property-write','provider-read',
                            'provider-read','provider-write',
                            'customer-read','customer-write'
                        ]);
        Bouncer::allow('post_manager')->to([
                            'post-read', 'post-write',
                            'category-read', 'category-write',
                            'page-read', 'page-write',
                        ]);
        Bouncer::allow('order_manager')->to([
                        'order-read', 'order-write',
                        'expense-read', 'product-read',
                        'customer-read','customer-write'
                    ]);
        User::find(1)->assign('system');
        User::find(2)->assign('admin');
    }
}
