<?php

namespace App\Jobs\Register;

use App\Jobs\Job;
use App\Repositories\Contracts\RegisterRepository;
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

    public function handle(RegisterRepository $repository)
    {
        $repository->update($this->entity, $this->attributes);
    }
}
