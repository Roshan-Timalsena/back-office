<?php

namespace App\Policies;

use App\Models\User;
use App\Models\bill;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class BillPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\bill  $bill
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, bill $bill)
    {
        //
        if($user->user_type == 'admin' || (Auth::check() && Auth::id()==$bill->user_id)){
            return true;
        } else {
            false;
        }
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\bill  $bill
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, bill $bill)
    {
        //
        if($user->user_type == 'admin' || (Auth::check() && Auth::id()==$bill->user_id)){
            return true;
        } else{
            return false;
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\bill  $bill
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, bill $bill)
    {
        //
        if($user->user_type == 'admin' || (Auth::check() && Auth::id()==$bill->user_id)){
            return true;
        } else{
            return false;
        }
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\bill  $bill
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, bill $bill)
    {
        //
        if($user->user_type == 'admin'){
            return true;
        } else{
            return false;
        }
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\bill  $bill
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, bill $bill)
    {
        //
        if($user->user_type == 'admin'){
            return true;
        } else{
            return false;
        }
    }
}
