<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;


class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function view(User $user, User $u)
    {
        //
        if($user->user_type == 'admin' || (Auth::check() && Auth::id() == $u->id)){
            return true;
        }
    }

    public function create(User $user)
    {
        //
        if($user->user_type == 'admin') {
            return true;
        }
    }

    public function update(User $user, User $u)
    {
        //
        if($user->user_type == 'admin'){
            return true;
        }
    }

    public function remove(User $user, User $u){
        if($user->user_type == 'admin'){
            return true;
        }
    }
}
