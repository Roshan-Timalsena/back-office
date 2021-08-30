<?php

namespace App\Policies;

use App\Models\User;
use App\Models\document;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class DocumentPolicy
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
     * @param  \App\Models\document  $document
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, document $document)
    {
        //
        $types = $user->user_type;
        foreach($types as $type){
            if($type == 'admin' || $type == 'docsAll' || $type == 'docsRead' || (Auth::check() && Auth::id()==$document->user_id)){
                return true;
            }
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
        $types = $user->user_type;
        foreach($types as $type){
            if($type == 'admin' || $type == 'docsAll' || $type == 'docsCreate'){
                return true;
            }
        }
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\document  $document
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, document $document)
    {
        //
        $types = $user->user_type;
        foreach($types as $type){
            if($type == 'admin' || $type == 'docsAll' || $type == 'docsUpdate'){
                return true;
            }
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\document  $document
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, document $document)
    {
        //
        $types = $user->user_type;
        foreach($types as $type){
            if($type == 'admin' || $type == 'docsAll' || $type == 'docsDelete'){
                return true;
            }
        }
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\document  $document
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user)
    {
        //
        $types = $user->user_type;
        foreach($types as $type){
            if($type == 'admin'){
                return true;
            }
        }
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\document  $document
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user)
    {
        //
        $types = $user->user_type;
        foreach($types as $type){
            if($type == 'admin'){
                return true;
            }
        }
    }
}
