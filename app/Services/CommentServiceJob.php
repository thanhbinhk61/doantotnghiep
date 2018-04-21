<?php

namespace App\Services;

use App\Services\Contracts\CommentService;
use Illuminate\Database\Eloquent\Model;
use App\Jobs\Comment\Store;
use App\Jobs\Comment\Delete;

class CommentServiceJob extends AbstractServiceJob implements CommentService
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
