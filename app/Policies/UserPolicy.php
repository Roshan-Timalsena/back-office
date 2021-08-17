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
        $types = $user->user_type;
        foreach($types as $type){
            if($type == 'admin' || (Auth::check() && Auth::id() == $u->id)){
                return true;
            }
        }
    }

    public function create(User $user)
    {
        //
        $types = $user->user_type;
        foreach($types as $type){
            if($type == 'admin'){
                return true;
            }
        }
    }

    public function update(User $user, User $u)
    {
        //
        $types = $user->user_type;
        foreach($types as $type){
            if($type == 'admin'){
                return true;
            }
        }
    }

    public function remove(User $user, User $u)
    {
        $types = $user->user_type;
        foreach($types as $type){
            if($type == 'admin'){
                return true;
            }
        }
    }
}
