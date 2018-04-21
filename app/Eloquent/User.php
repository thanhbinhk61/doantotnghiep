<?php

namespace App\Eloquent;

use Silber\Bouncer\Database\HasRolesAndAbilities;

class User extends Abstracts\Authenticatable
{
    use HasRolesAndAbilities;

    protected $fillable = [
        'name','username', 'email', 'password','image','phone'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts()
    {
    	return $this->hasMany(Post::class);
    }

    public function pages()
    {
        return $this->hasMany(Page::class);
    }

    public function notificationReceiver()
    {
        return $this->hasMany(Notification::class,'receiver_id');
    }

    public function notificationReceiverNotRead()
    {
        return $this->notificationReceiver()->where('read',0)->orderBy('id','DESC');
    }

    public function notificationReceiverNotReadLimit()
    {
        return $this->notificationReceiverNotRead()->take(10);
    }
}
