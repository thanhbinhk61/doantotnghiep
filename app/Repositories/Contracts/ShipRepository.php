<?php

namespace App\Repositories\Contracts;

interface ShipRepository extends AbstractRepository
{
	public function datatables($columns = ['*']);
}
