<?php

namespace App\Jobs\Order;

use App\Jobs\Job;
use App\Repositories\Contracts\OrderRepository;
use App\Repositories\Contracts\ExpenseRepository;

class Guest extends Job
{
    protected $attributes;

    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    public function handle(OrderRepository $repository)
    {
        $this->attributes['code'] = $this->generateCode();
        $this->attributes['ship'] = $this->getShip($this->attributes['ship_id']);
        $this->attributes['expense_id'] = $this->attributes['ship_id'];
        return $repository->create($this->attributes)->id;
    }

    public function generateCode()
    {
        return app(OrderRepository::class)->generate();
    }

    public function getShip($id)
    {
        return app(ExpenseRepository::class)->findOrFail($id)->price;
    }
}
