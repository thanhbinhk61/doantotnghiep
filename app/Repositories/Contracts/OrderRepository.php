<?php

namespace App\Repositories\Contracts;

interface OrderRepository extends AbstractRepository
{
	public function statisticsToday();

	public function statisticsMonthday();

	public function statisticsYearDay();
	
	public function statisticsOrder();

	public function datatables($columns = ['*']);

	public function generate();

	public function findByAttribute($code, $email);
}
