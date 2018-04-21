<?php

namespace App\Policies;

use App\Eloquent\User;
use App\Eloquent\Page;

class PagePolicy extends AbstractPolicy
{

    public function before($user, $ability)
    {
        if ($user->is('system') || $user->is('admin')) {
            return true;
        }
    }

    public function checkPage(User $user, Page $ability)
    {
        if ($user->id != $ability->user_id) {
            return false;
        }
        return true;
    }

    public function read(User $user, Page $ability)
    {
        if (!$this->checkAbility($user, __FUNCTION__, $ability)) {
            return false;
        }
        if ($ability->id) {
            if (!$this->checkPage($user, $ability)) {
                return false;
            }
        }
        return true;
    }

    public function write(User $user, Page $ability)
    {
        if (!$this->checkAbility($user, __FUNCTION__, $ability)) {
            return false;
        }
        if ($ability->id) {
            if (!$this->checkPage($user, $ability)) {
                return false;
            }
        }
        return true;
    }
}
