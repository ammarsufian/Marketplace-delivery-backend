<?php

namespace App\Policies;

use App\Domains\Authentication\Models\Admin;
use App\Domains\AccountManagement\Models\Branch;
use Illuminate\Auth\Access\HandlesAuthorization;

class BranchPolicy
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
        return $admin->hasPermissionTo('view-any-branch');
        
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\Domains\AccountManagement\Models\Branch  $modle
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $admin, Branch $model)
    {
        return $admin->hasPermissionTo('view-branch');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Admin $admin)
    {
        return $admin->hasPermissionTo('create-branch');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\Domains\AccountManagement\Models\Branch  $modle
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $admin, Branch $model)
    {
        return $admin->hasPermissionTo('update-branch');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\Domains\AccountManagement\Models\Branch  $modle
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin, Branch $model)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\Domains\AccountManagement\Models\Branch  $modle
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Admin $admin, Branch $model)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\Domains\AccountManagement\Models\Branch  $modle
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Admin $admin, Branch $model)
    {
        return false;
    }
}
