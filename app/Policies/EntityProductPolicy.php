<?php

namespace App\Policies;

use App\Domains\Authentication\Models\Admin;
use App\Domains\ProductManagement\Models\EntityProduct;
use Illuminate\Auth\Access\HandlesAuthorization;

class EntityProductPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     * 'view-any-entity-product','view-entity-product','create-entity-product','update-entity-product',
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(Admin $admin)
    {
        return $admin->hasPermissionTo('view-any-entity-product');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\Domains\ProductManagement\Models\EntityProduct  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $admin, EntityProduct $model)
    {
        return $admin->hasPermissionTo('view-entity-product');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Admin $admin)
    {
        return $admin->hasPermissionTo('create-entity-product');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\Domains\ProductManagement\Models\EntityProduct  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $admin, EntityProduct $model)
    {
        return $admin->hasPermissionTo('update-entity-product');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\Domains\ProductManagement\Models\EntityProduct  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin, EntityProduct $model)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\Domains\ProductManagement\Models\EntityProduct  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Admin $admin, EntityProduct $model)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\Domains\ProductManagement\Models\EntityProduct  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Admin $admin, EntityProduct $model)
    {
        return false;
    }
}
