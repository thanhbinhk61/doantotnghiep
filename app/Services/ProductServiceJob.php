<?php

namespace App\Services;

use App\Services\Contracts\ProductService;
use Illuminate\Database\Eloquent\Model;
use App\Jobs\Product\Store;
use App\Jobs\Product\Update;
use App\Jobs\Product\Delete;
use App\Jobs\Product\Viewed;

class ProductServiceJob extends AbstractServiceJob implements ProductService
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

	public function viewed(Model $entity)
	{
		return $this->dispatch(new Viewed($entity));
	}
}
