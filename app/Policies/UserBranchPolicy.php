<?php

namespace App\Policies;

use App\Domains\Authentication\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Domains\AccountManagement\Models\UserBranch;

class UserBranchPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(Admin $admin)
    {
        return $admin->hasPermissionTo('view-any-user-branch');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\Domains\AccountManagement\Models\UserBranch  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $admin, UserBranch $model)
    {
        return $admin->hasPermissionTo('view-user-branch');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Admin $admin)
    {
        return $admin->hasPermissionTo('create-user-branch');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\Domains\AccountManagement\Models\UserBranch  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $admin, UserBranch $model)
    {
        return $admin->hasPermissionTo('update-user-branch');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\Domains\AccountManagement\Models\UserBranch  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin, UserBranch $model)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\Domains\AccountManagement\Models\UserBranch  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Admin $admin, UserBranch $model)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\Domains\AccountManagement\Models\UserBranch  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Admin $admin, UserBranch $model)
    {
        return false;
    }
}
