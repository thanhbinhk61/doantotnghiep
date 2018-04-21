<?php

namespace App\Services;

use App\Services\Contracts\PostService;
use Illuminate\Database\Eloquent\Model;
use App\Jobs\Post\Store;
use App\Jobs\Post\Update;
use App\Jobs\Post\Delete;

class PostServiceJob extends AbstractServiceJob implements PostService
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
