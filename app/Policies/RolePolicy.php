<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Spatie\Permission\Models\Role;

class RolePolicy
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
     * Determine whether the user can view any models.
     *
     * @param  \App\Model\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasAnyPermission(['view role', 'create role', 'update role', 'assign role']);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Model\User  $user
     * @param  Spatie\Permission\Models\Role  $role
     * @return mixed
     */
    public function view(User $user, Role $role)
    {
        return $user->hasPermissionTo('view role');
    }

    /**
     * Determine whether the user can create models.
     *
     *  @param  \App\Model\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create role');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Model\User  $user
     * @param  Spatie\Permission\Models\Role $role
     * @return mixed
     */
    public function update(User $user, Role $role)
    {
        return  $user->hasPermissionTo('update role');
    }

    /**
     * Determine whether the user can assign models.
     *
     * @param  \App\Model\User  $user
     * @return mixed
     */
    public function assign(User $user)
    {
        return $user->hasPermissionTo('assign role');
    }
}
