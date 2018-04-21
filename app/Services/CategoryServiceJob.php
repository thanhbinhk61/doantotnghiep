<?php

namespace App\Services;

use App\Services\Contracts\CategoryService;
use Illuminate\Database\Eloquent\Model;
use App\Jobs\Category\Store;
use App\Jobs\Category\Update;
use App\Jobs\Category\Delete;

class CategoryServiceJob extends AbstractServiceJob implements CategoryService
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
