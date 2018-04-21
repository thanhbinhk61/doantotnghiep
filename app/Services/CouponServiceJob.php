<?php

namespace App\Services;

use App\Services\Contracts\CouponService;
use Illuminate\Database\Eloquent\Model;
use App\Jobs\Coupon\Store;
use App\Jobs\Coupon\Update;
use App\Jobs\Coupon\Delete;

class CouponServiceJob extends AbstractServiceJob implements CouponService
{
	public function store(array $attributes)
	{
		return $this->dispatch(new Store($attributes));
	}

	public function update(Model $entity, array $attributes)
	{
		return $this->dispatch(new Update($entity, $attributes));
	}

	public function delete(Model $entity)
	{
		return $this->dispatch(new Delete($entity));
	}
}
