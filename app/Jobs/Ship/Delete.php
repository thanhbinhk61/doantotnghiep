<?php

namespace App\Jobs\Ship;

use App\Jobs\Job;
use App\Repositories\Contracts\ShipRepository;
use Illuminate\Database\Eloquent\Model;

class Delete extends Job
{
    protected $entity;

    public function __construct(Model $entity)
    {
        $this->entity = $entity;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(ShipRepository $repository)
    {
        $repository->delete($this->entity);
    }
}
