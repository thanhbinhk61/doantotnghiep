<?php

namespace App\Jobs\Register;

use App\Jobs\Job;
use App\Repositories\Contracts\RegisterRepository;
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

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(RegisterRepository $repository)
    {
        $store = $repository->create($this->attributes);
        $this->notification($store);
    }

    public function notification(Model $store)
    {
        $url = parse_url(route('admin.register.edit',$store->id), PHP_URL_PATH);
        $name = $store->name;
        $text = "Có đăng ký mở gian hàng mới từ '{$name}'";
        $sender = $store->id;
        $receiver = app(UserService::class)->getUserByRole(['id'],'admin');
        foreach ($receiver as $value) {
            app(Notification::class)->create([
                'name' => $name,
                'text' => $text,
                'sender_id' => $sender,
                'receiver_id' => $value->id,
                'icon' => 'fa-user-secret',
                'url' => $url
            ]);
        }
    }
}
