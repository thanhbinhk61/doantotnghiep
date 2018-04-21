<?php

namespace App\Jobs\Page;

use App\Jobs\Job;
use App\Repositories\Contracts\PageRepository;

class Store extends Job
{
   protected $attributes;

    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    public function handle(PageRepository $repository)
    {
        $this->attributes['user_id'] = \Auth::user()->id;
        $repository->create($this->attributes);
    }
}
