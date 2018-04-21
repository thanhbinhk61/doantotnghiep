<?php

namespace App\Policies;

use App\Eloquent\User;
use App\Eloquent\Ship;

class ShipPolicy extends AbstractPolicy
{
   public function before($user, $ability)
    {
        if ($user->is('admin') || $user->is('system')) {
            return true;
        }
    }

    public function read(User $user, Ship $ability)
    {
        return true;
    }

    public function write(User $user, Ship $ability)
    {
        return true;
    }
}
