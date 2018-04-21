<?php

namespace App\Services;

use App\Services\Contracts\CustomerService;
use Illuminate\Database\Eloquent\Model;
use App\Jobs\Customer\Store;
use App\Jobs\Customer\Import;
use App\Jobs\Customer\Update;
use App\Jobs\Customer\Delete;
use App\Jobs\Customer\WishList;
use App\Jobs\Customer\StoreAddress;
use App\Jobs\Customer\DeleteAddress;
use App\Jobs\Customer\StoreCard;
use App\Jobs\Customer\DeleteCard;

class CustomerServiceJob extends AbstractServiceJob implements CustomerService
{
	public function store(array $attributes)
	{
		return $this->dispatch(new Store($attributes));
	}

	public function import(array $attributes)
	{
		return $this->dispatch(new Import($attributes));
	}

	public function update(Model $entity, array $attributes)
	{
		return $this->dispatch(new Update($entity, $attributes));
	}

	public function delete(Model $entity)
	{
		return $this->dispatch(new Delete($entity));
	}

	public function wishList($id, $action = 'create')
	{
		return $this->dispatch(new WishList($id, $action));
	}

	public function storeAddress(array $attributes)
	{
		return $this->dispatch(new StoreAddress($attributes));
	}

	public function storeCard(array $attributes)
	{
		return $this->dispatch(new StoreCard($attributes));
	}

	public function deleteAddress($id)
	{
		return $this->dispatch(new DeleteAddress($id));
	}

	public function deleteCard($id)
	{
		return $this->dispatch(new DeleteCard($id));
	}
}
