<?php

namespace App\Jobs\Expense;

use App\Jobs\Job;
use App\Repositories\Contracts\ExpenseRepository;
use Illuminate\Database\Eloquent\Model;

class Delete extends Job
{
    protected $entity;

    public function __construct(Model $entity)
    {
        $this->entity = $entity;
    }

    public function handle(ExpenseRepository $repository)
    {
        $repository->delete($this->entity);
    }
}
