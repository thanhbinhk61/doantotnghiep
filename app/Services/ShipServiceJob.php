<?php

namespace App\Services;

use App\Services\Contracts\ShipService;
use Illuminate\Database\Eloquent\Model;
use App\Jobs\Ship\Store;
use App\Jobs\Ship\Update;
use App\Jobs\Ship\Delete;

class ShipServiceJob extends AbstractServiceJob implements ShipService
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
