<?php

namespace App\Services;

use App\Services\Contracts\ExpenseService;
use Illuminate\Database\Eloquent\Model;
use App\Jobs\Expense\Store;
use App\Jobs\Expense\Update;
use App\Jobs\Expense\Delete;

class ExpenseServiceJob extends AbstractServiceJob implements ExpenseService
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
