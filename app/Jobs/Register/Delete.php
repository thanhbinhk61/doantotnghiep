<?php

namespace App\Jobs\Register;

use App\Jobs\Job;
use App\Repositories\Contracts\RegisterRepository;
use Illuminate\Database\Eloquent\Model;

class Delete extends Job
{
    protected $entity;

    public function __construct(Model $entity)
    {
        $this->entity = $entity;
    }

    public function handle(RegisterRepository $repository)
    {
        $repository->delete($this->entity);
    }
}
