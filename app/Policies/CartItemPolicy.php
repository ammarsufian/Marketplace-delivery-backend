<?php

namespace App\Policies;

use App\Domains\OrderManagement\Models\CartItem;
use App\Domains\Authentication\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class CartItemPolicy
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
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\CartItem  $cartItem
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $admin, CartItem $model)
    {
        return false;
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
     * @param  \App\CartItem  $cartItem
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $admin, CartItem $model)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\CartItem  $cartItem
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin, CartItem $model)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\CartItem  $cartItem
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Admin $admin, CartItem $model)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\CartItem  $cartItem
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Admin $admin, CartItem $model)
    {
        return false;
    }
}
