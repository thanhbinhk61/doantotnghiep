<?php

namespace App\Policies;

use App\Eloquent\User;
use App\Eloquent\Post;

class PostPolicy extends AbstractPolicy
{
    public function before($user, $ability)
    {
        if ($user->is('system') || $user->is('admin')) {
            return true;
        }
    }

    public function checkPost(User $user, Post $ability)
    {
        if ($user->id != $ability->user_id) {
            return false;
        }
        return true;
    }

    public function read(User $user, Post $ability)
    {
        if (!$this->checkAbility($user, __FUNCTION__, $ability)) {
            return false;
        }
        if ($ability->id) {
            if (!$this->checkPost($user, $ability)) {
                return false;
            }
        }
        return true;
    }

    public function write(User $user, Post $ability)
    {
        if (!$this->checkAbility($user, __FUNCTION__, $ability)) {
            return false;
        }
        if ($ability->id) {
            if (!$this->checkPost($user, $ability)) {
                return false;
            }
        }
        return true;
    }
}
