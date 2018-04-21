<?php

namespace App\Jobs\Expense;

use App\Jobs\Job;
use App\Repositories\Contracts\ExpenseRepository;

class Store extends Job
{
    protected $attributes;

    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    public function handle(ExpenseRepository $repository)
    {
        $repository->create($this->attributes);
    }
}
