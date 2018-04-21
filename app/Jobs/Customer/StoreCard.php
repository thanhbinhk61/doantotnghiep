<?php

namespace App\Jobs\Customer;

use App\Jobs\Job;
use App\Eloquent\Card;

class StoreCard extends Job
{
    protected $attributes;

    protected $customer;

    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
        $this->customer = \Auth::guard('frontend')->user();
    }

    public function handle()
    {
        $this->attributes['customer_id'] = $this->customer->id;
        app(Card::class)->create($this->attributes);
    }
}
