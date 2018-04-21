<?php

namespace App\Jobs\Order;

use App\Jobs\Job;
use App\Repositories\Contracts\OrderRepository;
use App\Repositories\Contracts\ExpenseRepository;
use Illuminate\Database\Eloquent\Model;

class UpdateGuest extends Job
{
    protected $attributes;

    protected $entity;

    public function __construct(Model $entity, array $attributes)
    {
        $this->attributes = $attributes;
        $this->entity = $entity;
    }

    public function handle(OrderRepository $repository)
    {
        $this->attributes['ship'] = $this->getShip($this->attributes['ship_id']);
        $this->attributes['expense_id'] = $this->attributes['ship_id'];
        return $repository->update($this->entity, $this->attributes);
    }

    public function getShip($id)
    {
        return app(ExpenseRepository::class)->findOrFail($id)->price;
    }
}
