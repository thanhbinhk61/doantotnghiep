<?php

namespace App\Repositories;

use App\Eloquent\Order;
use App\Repositories\Contracts\OrderRepository;

class OrderRepositoryEloquent extends AbstractRepositoryEloquent implements OrderRepository
{
    public function __construct(Order $model)
    {
        parent::__construct($model);
    }

    public function statisticsToday() 
    {
    	return $this->model->where('status',2)
    						->where(\DB::raw('DATE(created_at)'),\DB::raw('DATE(NOW())'))
    						->get();
    }

    public function statisticsMonthday()
    {
        return $this->model->where('status',2)
                            ->where(\DB::raw('DATE_FORMAT(created_at, "%Y-%m")'),\DB::raw('DATE_FORMAT(NOW(), "%Y-%m")'))
                            ->get();
    }

	public function statisticsYearDay()
	{
        return $this->model->where('status',2)
                            ->where(\DB::raw('DATE_FORMAT(created_at, "%Y")'),\DB::raw('DATE_FORMAT(NOW(), "%Y")'))
                            ->get();
	}
	
	public function statisticsOrder()
	{
        return $this->model->where('status',1)->get();
	}

    public function datatables($columns = ['*'])
    {
        return $this->model->with('customer')->where('status','>',1)->get($columns);
    }

    public function generate()
    {
        $exists = true;
        while ($exists) {
            $code = rand(10000000,1000000000);
            $check = $this->model->where('code', $code)->first();
            if(!count($check)) {
                $exists = false;
            }
        }
        return $code;
    }

    public function findByAttribute($code, $email)
    {
        return $this->model->where('code', $code)->where('email',$email)->first();
    }
}
