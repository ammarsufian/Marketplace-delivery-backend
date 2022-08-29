<?php

namespace App\Policies;

use App\Domains\Authentication\Models\Admin;
use App\Domains\AccountManagement\Models\Brand;
use Illuminate\Auth\Access\HandlesAuthorization;

class BrandPolicy
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
        return $admin->hasPermissionTo('view-any-brand');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\Domains\AccountManagement\Models\Brand  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $admin, Brand $model)
    {
        return $admin->hasPermissionTo('view-brand');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Admin $admin)
    {
        return $admin->hasPermissionTo('create-brand');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\Domains\AccountManagement\Models\Brand  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $admin, Brand $model)
    {
        return $admin->hasPermissionTo('update-brand');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\Domains\AccountManagement\Models\Brand  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin, Brand $model)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\Domains\AccountManagement\Models\Brand  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Admin $admin, Brand $model)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\Domains\AccountManagement\Models\Brand  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Admin $admin, Brand $model)
    {
        return false;
    }
}
