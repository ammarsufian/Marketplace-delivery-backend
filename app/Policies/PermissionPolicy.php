<?php

namespace App\Policies;

use App\Domains\Authentication\Models\Admin;
use Spatie\Permission\Models\Permission;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionPolicy
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
        return $admin->hasPermissionTo('view-any-permission');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \Spatie\Permission\Models\Permission  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $admin, Permission $model)
    {
        return $admin->hasPermissionTo('view-permission');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Admin $admin)
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \Spatie\Permission\Models\Permission  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $admin, Permission $model)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \Spatie\Permission\Models\Permission  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin, Permission $model)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \Spatie\Permission\Models\Permission  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Admin $admin, Permission $model)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \Spatie\Permission\Models\Permission  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Admin $admin, Permission $model)
    {
        return false;
    }
}
