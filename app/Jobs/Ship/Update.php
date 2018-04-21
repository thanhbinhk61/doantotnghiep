<?php

namespace App\Jobs\Ship;

use App\Jobs\Job;
use App\Repositories\Contracts\ShipRepository;
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

    public function handle(ShipRepository $repository)
    {
        return $repository->update($this->entity, $this->attributes);
    }
}
