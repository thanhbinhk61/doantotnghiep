<?php

namespace App\Jobs\Provider;

use App\Jobs\Job;
use App\Repositories\Contracts\ProviderRepository;
use Illuminate\Database\Eloquent\Model;

class Delete extends Job
{
    protected $entity;

    public function __construct(Model $entity)
    {
        $this->entity = $entity;
    }

    public function handle(ProviderRepository $repository)
    {
        if (!empty($this->entity->image)) {
            $this->destroyImage($this->entity->image);
        }
        if (!empty($this->entity->logo)) {
            $this->destroyImage($this->entity->logo);
        }
        $repository->delete($this->entity);
    }
}
