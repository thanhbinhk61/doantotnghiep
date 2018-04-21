<?php

namespace App\Services;

use App\Services\Contracts\ContactService;
use Illuminate\Database\Eloquent\Model;
use App\Jobs\Contact\Store;
use App\Jobs\Contact\Delete;

class ContactServiceJob extends AbstractServiceJob implements ContactService
{
	public function store(array $attributes)
	{
		return $this->dispatch(new Store($attributes));
	}

	public function update(Model $entity, array $attributes)
	{
	}

	public function delete(Model $entity)
	{
		return $this->dispatch(new Delete($entity));
	}
}
