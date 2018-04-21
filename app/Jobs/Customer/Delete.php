<?php

namespace App\Jobs\Customer;

use App\Jobs\Job;
use App\Repositories\Contracts\CustomerRepository;
use Illuminate\Database\Eloquent\Model;

class Delete extends Job
{
    protected $entity;

    public function __construct(Model $entity)
    {
        $this->entity = $entity;
    }

    public function handle(CustomerRepository $repository)
    {
        $repository->delete($this->entity);
    }
}
