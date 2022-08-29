<?php

namespace App\Policies;

use App\Domains\Authentication\Models\Admin;
use App\Domains\ProductManagement\Models\GroupVariant;
use Illuminate\Auth\Access\HandlesAuthorization;

class VariantGroupPolicy
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
        return $admin->hasPermissionTo('view-any-variant-group');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\GroupVariant  $variantGroup
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $admin, GroupVariant $model)
    {
        return $admin->hasPermissionTo('view-variant-group');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Admin $admin)
    {
        return $admin->hasPermissionTo('create-variant-group');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\GroupVariant  $variantGroup
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $admin, GroupVariant $model)
    {
        return $admin->hasPermissionTo('update-variant-group');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\GroupVariant  $variantGroup
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin, GroupVariant $model)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\GroupVariant  $variantGroup
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Admin $admin, GroupVariant $model)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\GroupVariant  $variantGroup
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Admin $admin, GroupVariant $model)
    {
        return false;
    }
}
