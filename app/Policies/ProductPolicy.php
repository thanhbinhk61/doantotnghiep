<?php

namespace App\Policies;

use App\Eloquent\User;
use App\Eloquent\Product;

class ProductPolicy extends AbstractPolicy
{
    public function before($user, $ability)
    {
        if ($user->is('system') || $user->is('admin')) {
            return true;
        }
    }

    public function checkProduct(User $user, Product $ability)
    {
        if ($user->id != $ability->user_id) {
            return false;
        }
        return true;
    }

    public function read(User $user, Product $ability)
    {
        if (!$this->checkAbility($user, __FUNCTION__, $ability)) {
            return false;
        }
        if ($ability->id) {
            if (!$this->checkProduct($user, $ability)) {
                return false;
            }
        }
        return true;
    }

    public function write(User $user, Product $ability)
    {
        if (!$this->checkAbility($user, __FUNCTION__, $ability)) {
            return false;
        }
        if ($ability->id) {
            if (!$this->checkProduct($user, $ability)) {
                return false;
            }
        }
        return true;
    }
}
