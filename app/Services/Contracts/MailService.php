<?php

namespace App\Services\Contracts;

use Illuminate\Database\Eloquent\Model;

interface MailService
{
	public function send(array $attributes, array $to , $view, $subject);

	public function sendOrder(Model $order);

	public function sendOrderStatus(Model $order, $newStatus);

	public function sendOrderShip(Model $ship, $message);
}
