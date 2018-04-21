<?php

namespace App\Services;

use App\Services\Contracts\MailService;
use App\Jobs\Mail\Send;
use Illuminate\Database\Eloquent\Model;
use App\Services\Contracts\UserService;

class MailServiceJob extends AbstractServiceJob implements MailService
{
	public function send(array $data, array $to , $view, $subject)
	{
		return $this->dispatch((new Send($data, $to, $view, $subject))->delay(60 * 5));
	}

	public function sendOrder(Model $order)
	{
		$data = $order->load(['customer','products'])->toArray();
        $toUser = app(UserService::class)->getUserByRole(['email'])->pluck('email')->all();
        $toCustomer = ($order->email) ? $order->email : $order->customer->email;
        $this->send($data, $toUser,'order','Có đơn hàng mới');
        $this->send($data, [$toCustomer], 'customer_order', 'Thông tin đơn hàng của bạn.');
	}

	public function sendOrderStatus(Model $order, $newStatus)
	{
		$data = $order->load(['customer','products'])->toArray();
		$data['newStatus'] = $newStatus;
		$toCustomer = ($order->email) ? $order->email : $order->customer->email;
		$this->send($data, [$toCustomer], 'status_order', 'Thay đổi trạng thái đơn hàng của bạn.');
	}

	public function sendOrderShip(Model $ship, $message)
	{
		$data = $ship->load(['customer'])->toArray();
		$data['message'] = $message;
		$toCustomer = ($ship->email) ? $ship->email : $ship->customer->email;
		$this->send($data, [$toCustomer], 'order_ship', 'Thông tin về sản phẩm order');
	}
}
