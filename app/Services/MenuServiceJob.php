<?php

namespace App\Services;

use App\Services\Contracts\MenuService;
use Illuminate\Database\Eloquent\Model;
use App\Jobs\Menu\Store;
use App\Jobs\Menu\Update;
use App\Jobs\Menu\Delete;

class MenuServiceJob extends AbstractServiceJob implements MenuService
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
