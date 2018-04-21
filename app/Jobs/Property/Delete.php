<?php

namespace App\Jobs\Property;

use App\Jobs\Job;
use App\Repositories\Contracts\PropertyRepository;
use Illuminate\Database\Eloquent\Model;

class Delete extends Job
{
    protected $entity;

    public function __construct(Model $entity)
    {
        $this->entity = $entity;
    }

    public function handle(PropertyRepository $repository)
    {
    	if (!empty($this->entity->logo)) {
            $this->destroyImage($this->entity->logo);
        }
        $repository->delete($this->entity);
    }
}
