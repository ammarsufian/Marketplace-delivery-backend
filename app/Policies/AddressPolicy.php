<?php

namespace App\Policies;

use App\Domains\Authentication\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Domains\AccountManagement\Models\Address;
class AddressPolicy
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
        return $admin->hasPermissionTo('view-any-address');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\Domains\AccountManagement\Models\Address  $address
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $admin, Address $model)
    {
        return $admin->hasPermissionTo('view-address');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Admin $model)
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\Domains\AccountManagement\Models\Address  $address
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $admin, Address $model)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\Domains\AccountManagement\Models\Address  $address
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin, Address $model)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\Domains\AccountManagement\Models\Address  $address
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Admin $admin, Address $model)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\Domains\AccountManagement\Models\Address  $address
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Admin $admin, Address $address)
    {
        return false;
    }
}
