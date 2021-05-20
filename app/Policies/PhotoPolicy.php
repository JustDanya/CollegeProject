<?php

namespace App\Policies;

use App\Photos;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PhotoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any photos.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the photos.
     *
     * @param  \App\User  $user
     * @param  \App\Photos  $photos
     * @return mixed
     */
    public function view(User $user, Photos $photos)
    {
        //
    }

    /**
     * Determine whether the user can create photos.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the photos.
     *
     * @param  \App\User  $user
     * @param  \App\Photos  $photos
     * @return mixed
     */
    public function update(User $user, Photos $photos)
    {
        return $user->id === $photos->user_id;
    }

    /**
     * Determine whether the user can delete the photos.
     *
     * @param  \App\User  $user
     * @param  \App\Photos  $photos
     * @return mixed
     */
    public function delete(User $user, Photos $photos)
    {
        //
    }

    /**
     * Determine whether the user can restore the photos.
     *
     * @param  \App\User  $user
     * @param  \App\Photos  $photos
     * @return mixed
     */
    public function restore(User $user, Photos $photos)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the photos.
     *
     * @param  \App\User  $user
     * @param  \App\Photos  $photos
     * @return mixed
     */
    public function forceDelete(User $user, Photos $photos)
    {
        //
    }
}
