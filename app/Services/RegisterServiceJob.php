<?php

namespace App\Services;

use App\Services\Contracts\RegisterService;
use Illuminate\Database\Eloquent\Model;
use App\Jobs\Register\Store;
use App\Jobs\Register\Update;
use App\Jobs\Register\Delete;

class RegisterServiceJob extends AbstractServiceJob implements RegisterService
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
