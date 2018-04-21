<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
    'name','price','status','note','type'
    ];

    public function order()
    {
        return $this->hasMany(Order::class);
    }
}
