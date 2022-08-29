<?php

namespace App\Policies;

use App\Domains\Authentication\Models\Admin;
use App\Domains\OrderManagement\Models\PromoCode;
use Illuminate\Auth\Access\HandlesAuthorization;

class PromoCodePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *  'view-any-promo-code','view-promo-code','create-promo-code','update-promo-code',
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(Admin $admin)
    {
        return $admin->hasPermissionTo('view-any-promo-code');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  App\Domains\OrderManagement\Models\PromoCode  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $admin, PromoCode $model)
    {
        return $admin->hasPermissionTo('view-promo-code');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Admin $admin)
    {
        return $admin->hasPermissionTo('create-promo-code');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  App\Domains\OrderManagement\Models\PromoCode  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $admin, PromoCode $model)
    {
        return $admin->hasPermissionTo('update-promo-code');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  App\Domains\OrderManagement\Models\PromoCode  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin, PromoCode $model)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  App\Domains\OrderManagement\Models\PromoCode  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Admin $admin, PromoCode $model)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  App\Domains\OrderManagement\Models\PromoCode  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Admin $admin, PromoCode $model)
    {
        return false;
    }
}
