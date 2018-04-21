<?php

namespace App\Services;

use App\Services\Contracts\RoleService;
use Illuminate\Database\Eloquent\Model;
use App\Jobs\Role\Store;
use App\Jobs\Role\Update;
use App\Jobs\Role\Delete;

class RoleServiceJob extends AbstractServiceJob implements RoleService
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
