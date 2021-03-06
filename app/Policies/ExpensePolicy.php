<?php

namespace App\Policies;

use App\Eloquent\User;
use App\Eloquent\Expense;

class ExpensePolicy extends AbstractPolicy
{
    public function before($user, $ability)
    {
        if ($user->is('admin') || $user->is('system')) {
            return true;
        }
    }

    public function read(User $user, Expense $ability)
    {
        if (!$this->checkAbility($user, __FUNCTION__, $ability)) {
            return false;
        }
        return true;
    }

    public function write(User $user, Expense $ability)
    {
        if (!$this->checkAbility($user, __FUNCTION__, $ability)) {
            return false;
        }
        return true;
    }
}
