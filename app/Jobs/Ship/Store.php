<?php

namespace App\Jobs\Ship;

use App\Jobs\Job;
use App\Repositories\Contracts\ShipRepository;
use App\Eloquent\Notification;
use Illuminate\Database\Eloquent\Model;
use App\Services\Contracts\UserService;

class Store extends Job
{
    protected $attributes;

    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    public function handle(ShipRepository $repository)
    {
        $ship = $repository->create($this->attributes);
        $this->notification($ship);
    }

    public function notification(Model $ship)
    {
        $url = parse_url(route('admin.ship.show',$ship->id), PHP_URL_PATH);
        $name = $ship->name ? $ship->name : $ship->customer->name;
        $text = "Có order ship hàng mới từ '{$name}'";
        $sender = $ship->id;
        $receiver = app(UserService::class)->getUserByRole(['id']);
        foreach ($receiver as $value) {
            app(Notification::class)->create([
                'name' => $name,
                'text' => $text,
                'sender_id' => $sender,
                'receiver_id' => $value->id,
                'icon' => 'fa-cube',
                'url' => $url
            ]);
        }
    }
}
