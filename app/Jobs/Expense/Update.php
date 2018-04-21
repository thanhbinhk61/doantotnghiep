<?php

namespace App\Jobs\Expense;

use App\Jobs\Job;
use App\Repositories\Contracts\ExpenseRepository;
use Illuminate\Database\Eloquent\Model;

class Update extends Job
{
    protected $attributes;

    protected $entity;

    public function __construct(Model $entity, array $attributes)
    {
        $this->attributes = $attributes;
        $this->entity = $entity;
    }

    public function handle(ExpenseRepository $repository)
    {
        $repository->update($this->entity, $this->attributes);
    }
}
