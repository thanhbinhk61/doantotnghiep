<?php

namespace App\Jobs\Coupon;

use App\Jobs\Job;
use App\Repositories\Contracts\CouponRepository;
use Illuminate\Database\Eloquent\Model;

class Update extends Job
{
    protected $attributes;

    protected $entity;

    public function __construct(Model $entity, array $attributes)
    {
        $this->attributes = $attributes;
        $this->entity = $entity;
    }

    public function handle(CouponRepository $repository)
    {
        if (isset($this->attributes['quantity'])) {
            unset($this->attributes['quantity']);
        }
        if (isset($this->attributes['type'])) {
            unset($this->attributes['type']);
        }
        if (isset($this->attributes['value'])) {
            unset($this->attributes['value']);
        }
        if (isset($this->attributes['min'])) {
            unset($this->attributes['min']);
        }
        if (isset($this->attributes['expired_at'])) {
            $this->attributes['expired_at'] = date('Y-m-d H:i:s',strtotime($this->attributes['expired_at']));
        }
        $repository->update($this->entity, $this->attributes);
        if (isset($this->attributes['cate_id'])) {
            $this->entity->categories()->sync($this->attributes['cate_id']);
        }
    }
}
