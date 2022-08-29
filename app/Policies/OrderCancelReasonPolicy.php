<?php

namespace App\Policies;

use App\Domains\Authentication\Models\Admin;
use App\Domains\OrderManagement\Models\OrderCancelReason;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderCancelReasonPolicy
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
        return $admin->hasPermissionTo('view-any-order-cancel-reason');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\Domains\OrderManagement\Models\OrderCancelReason  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $admin, OrderCancelReason $model)
    {
        return $admin->hasPermissionTo('view-order-cancel-reason');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Admin $admin)
    {
        return $admin->hasPermissionTo('create-order-cancel-reason');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\Domains\OrderManagement\Models\OrderCancelReason  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $admin, OrderCancelReason $model)
    {
        return $admin->hasPermissionTo('update-order-cancel-reason');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\Domains\OrderManagement\Models\OrderCancelReason  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin, OrderCancelReason $model)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\Domains\OrderManagement\Models\OrderCancelReason  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Admin $admin, OrderCancelReason $model)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\Domains\OrderManagement\Models\OrderCancelReason  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Admin $admin, OrderCancelReason $model)
    {
        return false;
    }
}
