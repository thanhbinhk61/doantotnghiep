<?php

namespace App\Jobs\Config;

use App\Jobs\Job;
use App\Repositories\Contracts\ConfigRepository;
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

    public function handle(ConfigRepository $repository)
    {
        if (isset($this->attributes['logo'])) {
            $path = strtolower(class_basename($repository->getModel()));
            if (!empty($this->entity->logo)) {
                $this->destroyImage($this->entity->logo);
            }
            $this->attributes['logo'] = $this->setImage($this->attributes['logo'],$path);
        }

        if (isset($this->attributes['icon'])) {
            $path = strtolower(class_basename($repository->getModel()));
            if (!empty($this->entity->icon)) {
                $this->destroyImage($this->entity->icon);
            }
            $this->attributes['icon'] = $this->setImage($this->attributes['icon'],$path);
        }

        if (isset($this->attributes['banner_login'])) {
            $path = strtolower(class_basename($repository->getModel()));
            if (!empty($this->entity->banner_login)) {
                $this->destroyImage($this->entity->banner_login);
            }
            $this->attributes['banner_login'] = $this->setImage($this->attributes['banner_login'],$path);
        }

        $repository->update($this->entity, $this->attributes);
    }
}
