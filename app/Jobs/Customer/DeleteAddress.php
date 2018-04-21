<?php

namespace App\Jobs\Customer;

use App\Jobs\Job;
use App\Eloquent\Address;

class DeleteAddress extends Job
{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function handle()
    {
        app(Address::class)->findOrFail($this->id)->delete();
    }
}
