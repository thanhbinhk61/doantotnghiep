<?php

namespace App\ELoquent;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['name','text','sender_id','receiver_id','url','icon','read'];
}
