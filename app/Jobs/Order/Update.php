<?php

namespace App\Jobs\Order;

use App\Jobs\Job;
use App\Repositories\Contracts\OrderRepository;
use App\Repositories\Contracts\ProductRepository;
use Illuminate\Database\Eloquent\Model;

class Update extends Job
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
        if (isset($this->attributes['status'])) {
            if ($this->attributes['status'] == 88) {
                foreach ($this->entity->products as $item) {
                    $this->updateQuantity($item);
                }
            }

            $repository->update($this->entity, ['status' => $this->attributes['status']]);
        }
    }

    public function updateQuantity(Model $product)
    {
        $orderQuantity = (int) $product->pivot->quantity;
        $quantityProduct = (int) $product->quantity;
        return app(ProductRepository::class)->update($product, ['quantity' => ($quantityProduct - $orderQuantity)]);
    }
}
