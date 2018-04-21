<?php

namespace App\Jobs\Role;

use App\Jobs\Job;
use Bouncer;

class Store extends Job
{
    protected $attributes;

    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    public function handle()
    {
        $role = Bouncer::Role()->create([
                'name' => $this->attributes['name']
            ]);
        if (isset($this->attributes['ability_id'])) {
            $role->abilities()->sync($this->attributes['ability_id']);
        }
    }
}
