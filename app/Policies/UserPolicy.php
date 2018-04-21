<?php

namespace App\Policies;

use App\Eloquent\User;

class UserPolicy extends AbstractPolicy
{
    public function checkSystem(User $user, User $ability)
    {
        if ($ability->is('system')) {
            return false;
        }
        return true;
    }

    public function checkAdmin(User $user, User $ability)
    {
        if ($ability->is('admin') && $user->is('admin')) {
            if ($user->id != $ability->id && $user->id != 2) {
                return false;
            }
        }
        if ($ability->is('admin') && $user->id !=2) {
            return false;
        }
        return true;
    }

    public function checkNotAdmin(User $user, User $ability)
    {   
        if ($user->isNot('admin') && $user->id != $ability->id) {
            return false;
        }
        return true;
    }

    public function read(User $user, User $ability)
    {
        if (!$this->checkAbility($user, __FUNCTION__, $ability)) {
            return false;
        }
        if ($ability->id) {
            if (!$this->checkSystem($user, $ability)) {
                return false;
            }
            if (!$this->checkAdmin($user, $ability)) {
                return false;
            }
            if (!$this->checkNotAdmin($user, $ability)) {
                return false;
            }
        }
        return true;
    }
    public function write(User $user, User $ability)
    {
        if (!$this->checkAbility($user, __FUNCTION__, $ability)) {
            return false;
        }
        if ($ability->id) {
            if (!$this->checkSystem($user, $ability)) {
                return false;
            }
            if (!$this->checkAdmin($user, $ability)) {
                return false;
            }
            if (!$this->checkNotAdmin($user, $ability)) {
                return false;
            }
        }
        return true;
    }
}
