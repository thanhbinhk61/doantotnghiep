<?php

namespace App\Repositories\Contracts;

interface UserRepository extends AbstractRepository
{
	public function all($columns = ['*']);
}
