<?php

namespace App\Services;

use App\Services\Contracts\OrderService;
use Illuminate\Database\Eloquent\Model;
use App\Jobs\Order\Delete;
use App\Jobs\Order\Update;
use App\Jobs\Order\Guest;
use App\Jobs\Order\UpdateGuest;
use App\Jobs\Order\Payment;

class OrderServiceJob extends AbstractServiceJob implements OrderService
{
	public function store(array $attributes)
	{
	}

	public function update(Model $entity, array $attributes)
	{
		return $this->dispatch(new Update($entity, $attributes));
	}

	public function delete(Model $entity)
	{
		return $this->dispatch(new Delete($entity));
	}

	public function guest(array $attributes)
	{
		return $this->dispatch(new Guest($attributes));
	}

	public function updateGuest(Model $entity, array $attributes)
	{
		return $this->dispatch(new UpdateGuest($entity, $attributes));
	}

	public function payment($code = null, $addressId = null, $orderId = null, $cardId = null)
	{
		return $this->dispatch(new Payment($code, $addressId, $orderId, $cardId));
	}
}
