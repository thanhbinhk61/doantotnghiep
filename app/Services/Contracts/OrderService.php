<?php

namespace App\Services\Contracts;

use Illuminate\Database\Eloquent\Model;

interface OrderService extends AbstractService
{
	public function guest(array $attributes);

	public function updateGuest(Model $entity, array $attributes);

	public function payment($code = null, $addressId = null, $orderId = null, $cardId = null);
	
}
