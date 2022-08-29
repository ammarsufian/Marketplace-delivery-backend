<?php

namespace App\Policies;

use App\Domains\Authentication\Models\Admin;
use App\Domains\OrderManagement\Models\Order;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *             'view-any-order','view-order',
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(Admin $admin)
    {
        return $admin->hasPermissionTo('view-any-order');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\Domains\OrderManagement\Models\Order  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $admin, Order $model)
    {
        return $admin->hasPermissionTo('view-order');
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
     * @param  \App\Domains\OrderManagement\Models\Order  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $admin, Order $model)
    {
        return $admin->hasPermissionTo('update-order');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\Domains\OrderManagement\Models\Order  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin, Order $model)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\Domains\OrderManagement\Models\Order  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Admin $admin, Order $model)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\Domains\OrderManagement\Models\Order  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Admin $admin, Order $model)
    {
        return false;
    }
}
