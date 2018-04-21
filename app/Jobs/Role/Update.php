<?php

namespace App\Jobs\Role;

use App\Jobs\Job;
use Bouncer;
use Illuminate\Database\Eloquent\Model;

class Update extends Job
{
    protected $attributes;

    protected $entity;

    public function __construct(Model $entity, array $attributes)
    {
        $this->entity = $entity;
        $this->attributes = $attributes;
    }

    public function handle()
    {
        $this->entity->update([
                'name' => $this->attributes['name']
            ]);
        if (isset($this->attributes['ability_id'])) {
            $this->entity->abilities()->sync($this->attributes['ability_id']);
        }
    }
}
