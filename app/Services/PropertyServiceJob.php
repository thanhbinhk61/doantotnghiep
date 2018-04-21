<?php

namespace App\Services;

use App\Services\Contracts\PropertyService;
use Illuminate\Database\Eloquent\Model;
use App\Jobs\Property\Store;
use App\Jobs\Property\Update;
use App\Jobs\Property\Delete;

class PropertyServiceJob extends AbstractServiceJob implements PropertyService
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
