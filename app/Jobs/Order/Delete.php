<?php

namespace App\Jobs\Order;

use App\Jobs\Job;
use App\Repositories\Contracts\OrderRepository;
use Illuminate\Database\Eloquent\Model;

class Delete extends Job
{
    protected $entity;

    public function __construct(Model $entity)
    {
        $this->entity = $entity;
    }

    public function handle(OrderRepository $repository)
    {
        $repository->delete($this->entity);
    }
}
