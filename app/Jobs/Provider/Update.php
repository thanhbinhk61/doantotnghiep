<?php

namespace App\Jobs\Provider;

use App\Jobs\Job;
use App\Repositories\Contracts\ProviderRepository;
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

    public function handle(ProviderRepository $repository)
    {
        if (isset($this->attributes['image'])) {
            $path = strtolower(class_basename($repository->getModel()));
            if (!empty($this->entity->image)) {
                $this->destroyImage($this->entity->image);
            }
            $this->attributes['image'] = $this->setImage($this->attributes['image'],$path);
        }
        if (isset($this->attributes['logo'])) {
            $path = strtolower(class_basename($repository->getModel()));
            if (!empty($this->entity->logo)) {
                $this->destroyImage($this->entity->logo);
            }
            $this->attributes['logo'] = $this->setImage($this->attributes['logo'],$path);
        }
        $repository->update($this->entity, $this->attributes);
    }
}