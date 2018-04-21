<?php

namespace App\Services\Contracts;

interface UserService extends AbstractService
{
	public function getUserByRole($columns = ['*'], $role = 'order_manager');
}
