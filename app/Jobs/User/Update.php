<?php

namespace App\Jobs\User;

use App\Jobs\Job;
use App\Repositories\Contracts\UserRepository;
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

    public function handle(UserRepository $repository)
    {
        if (isset($this->attributes['image'])) {
            $path = strtolower(class_basename($repository->getModel()));
            if (!empty($this->entity->image)) {
                $this->destroyImage($this->entity->image);
            }
            $this->attributes['image'] = $this->setImage($this->attributes['image'],$path);
        }
        if (isset($this->attributes['password'])) {
            $this->attributes['password'] = bcrypt($this->attributes['password']);
        }
        if (isset($this->attributes['role_id'])) {
            $this->entity->roles()->sync($this->attributes['role_id']);
        }
        $repository->update($this->entity, $this->attributes);
    }
}
