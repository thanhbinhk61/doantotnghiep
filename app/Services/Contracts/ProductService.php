<?php

namespace App\Services\Contracts;

use Illuminate\Database\Eloquent\Model;

interface ProductService extends AbstractService
{
	public function viewed(Model $entity);
}
