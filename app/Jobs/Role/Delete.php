<?php

namespace App\Jobs\Role;

use App\Jobs\Job;
use Illuminate\Database\Eloquent\Model;

class Delete extends Job
{
    protected $entity;

    public function __construct(Model $entity)
    {
        $this->entity = $entity;
    }

    public function handle()
    {
        $this->entity->delete();
    }
}
