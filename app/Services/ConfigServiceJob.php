<?php

namespace App\Services;

use App\Services\Contracts\ConfigService;
use Illuminate\Database\Eloquent\Model;
use App\Jobs\Config\Store;
use App\Jobs\Config\Update;
use App\Jobs\Config\Delete;

class ConfigServiceJob extends AbstractServiceJob implements ConfigService
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
