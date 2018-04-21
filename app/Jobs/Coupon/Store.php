<?php

namespace App\Jobs\Coupon;

use App\Jobs\Job;
use App\Repositories\Contracts\CouponRepository;
use App\Eloquent\CouponCode;

class Store extends Job
{
    protected $attributes;

    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    public function handle(CouponRepository $repository)
    {
        if (isset($this->attributes['expired_at'])) {
            $this->attributes['expired_at'] = date('Y-m-d H:i:s',strtotime($this->attributes['expired_at']));
        }
        $item = $repository->create($this->attributes);
        if (isset($this->attributes['quantity']) && $this->attributes['quantity'] > 0) {
            $dataSync = $this->createCode($this->attributes['quantity']);
            $item->codes()->saveMany($dataSync);
        }

        if (isset($this->attributes['cate_id'])) {
            $item->categories()->sync($this->attributes['cate_id']);
        }
    }

    public function createCode($quantity)
    {
        $array = [];
        for ($i = 0; $i < $quantity; $i++) {
            $code = app(CouponCode::class)->generate();
            $item = CouponCode::create([
                        'code' => $code,
                    ]);
            array_push($array, $item);
        }
        return $array;
    }
}
