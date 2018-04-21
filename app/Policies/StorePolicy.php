<?php

namespace App\Policies;

use App\Eloquent\User;
use App\Eloquent\Register;

class StorePolicy extends AbstractPolicy
{
    public function before($user, $ability)
    {
        if ($user->is('admin') || $user->is('system')) {
            return true;
        }
    }

    public function read(User $user, Register $ability)
    {
        return true;
    }

    public function write(User $user, Register $ability)
    {
        return true;
    }
}
