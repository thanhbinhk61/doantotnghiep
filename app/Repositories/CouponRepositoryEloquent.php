<?php

namespace App\Repositories;

use App\Eloquent\Coupon;
use App\Repositories\Contracts\CouponRepository;

class CouponRepositoryEloquent extends AbstractRepositoryEloquent implements CouponRepository
{
    public function __construct(Coupon $model)
    {
        parent::__construct($model);
    }    
}
