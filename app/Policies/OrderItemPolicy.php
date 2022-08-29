<?php

namespace App\Policies;

use App\Domains\Authentication\Models\Admin;
use App\Domains\OrderManagement\Models\OrderItem;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderItemPolicy
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
        return $admin->hasPermissionTo('view-any-order-item');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\OrderItem  $orderItem
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $admin, OrderItem $model)
    {
        return $admin->hasPermissionTo('view-order-item');;   
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
     * @param  \App\OrderItem  $orderItem
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $admin, OrderItem $model)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\OrderItem  $orderItem
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin, OrderItem $model)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\OrderItem  $orderItem
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Admin $admin, OrderItem $model)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\OrderItem  $orderItem
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Admin $admin, OrderItem $model)
    {
        return false;
    }
}
