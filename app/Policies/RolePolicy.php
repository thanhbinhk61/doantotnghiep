<?php

namespace App\Policies;

use App\Eloquent\User;
use Silber\Bouncer\Database\Role;

class RolePolicy extends AbstractPolicy
{
    public function checkRole(User $user, Role $ability)
    {
        if ($ability->name == 'system' || $ability->name == 'admin'
             || $ability->name == 'product_manager' 
             || $ability->name == 'post_manager' 
             || $ability->name == 'order_manager') {
            return false;
        }
        return true;
    }
    public function read(User $user, Role $ability)
    {
        if (!$this->checkAbility($user, __FUNCTION__, $ability)) {
            return false;
        }
        if ($ability->id) {
            if (!$this->checkRole($user, $ability)) {
                return false;
            }
        }
        return true;
    }

    public function write(User $user, Role $ability)
    {
        if (!$this->checkAbility($user, __FUNCTION__, $ability)) {
            return false;
        }
        if ($ability->id) {
            if (!$this->checkRole($user, $ability)) {
                return false;
            }
        }
        return true;
    }

}
