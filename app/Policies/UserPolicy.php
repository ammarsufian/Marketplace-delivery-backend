<?php

namespace App\Policies;

use App\Domains\Authentication\Models\Admin;
use App\Domains\Authentication\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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
        return $admin->hasPermissionTo('view-any-user');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \\App\Domains\Authentication\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $admin, User $model)
    {
        return $admin->hasPermissionTo('view-user');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Admin $admin)
    {
        return $admin->hasPermissionTo('create-user');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \\\App\Domains\Authentication\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $admin, User $model)
    {
        return $admin->hasPermissionTo('update-user');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \\App\Domains\Authentication\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin, User $model)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \\App\Domains\Authentication\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Admin $admin, User $model)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \\App\Domains\Authentication\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Admin $admin, User $model)
    {
        return false;
    }
}
