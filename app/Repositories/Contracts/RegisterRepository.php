<?php

namespace App\Repositories\Contracts;

interface RegisterRepository extends AbstractRepository
{
	public function datatables($columns = ['*']);
}
