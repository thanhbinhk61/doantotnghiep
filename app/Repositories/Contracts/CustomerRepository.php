<?php

namespace App\Repositories\Contracts;

interface CustomerRepository extends AbstractRepository
{
	public function findCustomerFacebook($customerID);

	public function findCustomerGoogle($customerID);

	public function datatables($column = ['*']);

	public function providers($column = ['*']);
}
