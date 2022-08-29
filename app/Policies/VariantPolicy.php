<?php

namespace App\Policies;

use App\Domains\Authentication\Models\Admin;
use App\Domains\ProductManagement\Models\Variant;
use Illuminate\Auth\Access\HandlesAuthorization;

class VariantPolicy
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
        return $admin->hasPermissionTo('view-any-variant');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\Variant  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $admin, Variant $model)
    {
        return $admin->hasPermissionTo('view-variant');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Admin $admin)
    {
        return $admin->hasPermissionTo('create-variant');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\Variant  $variant
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $admin, Variant $model)
    {
        return $admin->hasPermissionTo('update-variant');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\Variant  $variant
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin, Variant $model)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\Variant  $variant
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Admin $admin, Variant $model)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\Variant  $variant
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Admin $admin, Variant $model)
    {
        return false;
    }
}
