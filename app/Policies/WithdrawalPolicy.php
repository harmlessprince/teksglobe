<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Withdraw;
use Illuminate\Auth\Access\HandlesAuthorization;

class WithdrawalPolicy
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
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Model\Withdraw  $withdrawal
     * @return mixed
     */
    public function update(User $user)

    {
        return $user->hasAnyPermission(['confirm Withdrawal', 'decline Withdrawal']);
    }
}
