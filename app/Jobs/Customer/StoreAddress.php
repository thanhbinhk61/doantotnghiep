<?php

namespace App\Jobs\Customer;

use App\Jobs\Job;
use App\Eloquent\Address;

class StoreAddress extends Job
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
        $this->attributes['expense_id'] = $this->attributes['ship_id'];
        $address = app(Address::class)->create($this->attributes);
    }
}
