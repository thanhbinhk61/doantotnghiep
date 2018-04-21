<?php

namespace App\Jobs\Customer;

use App\Jobs\Job;
use App\Eloquent\Card;

class DeleteCard extends Job
{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function handle()
    {
        app(Card::class)->findOrFail($this->id)->delete();
    }
}
