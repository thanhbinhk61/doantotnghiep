<?php

namespace App\Jobs\Customer;

use App\Jobs\Job;

class WishList extends Job
{
    protected $productId;

    protected $action;

    public function __construct($productId, $action)
    {
        $this->productId = $productId;
        $this->action = $action;
    }

    public function handle()
    {
        $customer = \Auth::guard('frontend')->user();
        if ($customer) {
            if ($this->action === 'create') {
                $customer->products()->attach($this->productId);
            } elseif ($this->action === 'delete') {
                $customer->products()->detach($this->productId);
            } else return;
        } 
    }
}
