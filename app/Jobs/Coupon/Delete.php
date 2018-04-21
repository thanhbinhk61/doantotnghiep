<?php

namespace App\Jobs\Coupon;

use App\Jobs\Job;
use App\Repositories\Contracts\CouponRepository;
use Illuminate\Database\Eloquent\Model;

class Delete extends Job
{
    protected $entity;

    public function __construct(Model $entity)
    {
        $this->entity = $entity;
    }

    public function handle(CouponRepository $repository)
    {
        $this->entity->codes()->delete();
        $repository->delete($this->entity);
    }
}
