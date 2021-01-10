<?php

namespace App\Policies;

use App\Models\Package;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PackagePolicy
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

    /**
     * Determine whether the user can create the model.
     *
     * @param  \App\User  $user
     * @param  \App\Model\Package $package
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create package');
    }

     /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Model\Package $package
     * @return mixed
     */
    public function update(User $user, Package $package)
    {
        return $user->hasPermissionTo('update package');
    }

      /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Model\Package $package
     * @return mixed
     */
    public function delete(User $user, Package $package)
    {
        return $user->hasPermissionTo('delete package');
    }
}
