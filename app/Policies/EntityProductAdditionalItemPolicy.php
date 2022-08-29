<?php

namespace App\Policies;

use App\Domains\Authentication\Models\Admin;
use App\Domains\ProductManagement\Models\EntityProductAdditionalItem;
use Illuminate\Auth\Access\HandlesAuthorization;

class EntityProductAdditionalItemPolicy
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
        return $admin->hasPermissionTo('view-any-entity-product-additional-item');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\Domains\ProductManagement\Models\EntityProductAdditionalItem  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $admin, EntityProductAdditionalItem $model)
    {
        return $admin->hasPermissionTo('view-entity-product-additional-item');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Admin $admin)
    {
        return $admin->hasPermissionTo('create-entity-product-additional-item');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\Domains\ProductManagement\Models\EntityProductAdditionalItem  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $admin, EntityProductAdditionalItem $model)
    {
        return $admin->hasPermissionTo('update-entity-product-additional-item');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\Domains\ProductManagement\Models\EntityProductAdditionalItem  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin, EntityProductAdditionalItem $model)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\Domains\ProductManagement\Models\EntityProductAdditionalItem  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Admin $admin, EntityProductAdditionalItem $model)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\Domains\ProductManagement\Models\EntityProductAdditionalItem  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Admin $admin, EntityProductAdditionalItem $model)
    {
        return false;
    }
}
