<?php

namespace App\Policies;

use App\Eloquent\User;
use App\Eloquent\Provider;

class ProviderPolicy extends AbstractPolicy
{
    public function before($user, $ability)
    {
        if ($user->is('admin') || $user->is('system')) {
            return true;
        }
    }

    public function read(User $user, Provider $ability)
    {
        if (!$this->checkAbility($user, __FUNCTION__, $ability)) {
            return false;
        }
        return true;
    }

    public function write(User $user, Provider $ability)
    {
        if (!$this->checkAbility($user, __FUNCTION__, $ability)) {
            return false;
        }
        return true;
    }
}
