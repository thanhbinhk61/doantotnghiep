<?php

namespace App\Services\Contracts;

use Illuminate\Database\Eloquent\Model;

interface CustomerService extends AbstractService
{
	public function import(array $attributes);

	public function wishList($id, $action = 'create');

	public function storeAddress(array $attributes);

	public function storeCard(array $attributes);

	public function deleteAddress($id);

	public function deleteCard($id);
}
