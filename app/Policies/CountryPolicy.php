<?php

namespace App\Policies;

use App\Domains\Authentication\Models\Admin;
use App\Domains\ApplicationManagement\Models\Country;
use Illuminate\Auth\Access\HandlesAuthorization;

class CountryPolicy
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
        return $admin->hasPermissionTo('view-any-country');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\Domains\ApplicationManagement\Models\Country  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $admin, Country $model)
    {
        return $admin->hasPermissionTo('view-country');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Admin $admin)
    {
        return $admin->hasPermissionTo('create-country');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\Domains\ApplicationManagement\Models\Country  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $admin, Country $model)
    {
        return $admin->hasPermissionTo('update-country');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\Domains\ApplicationManagement\Models\Country  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin, Country $model)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\Domains\ApplicationManagement\Models\Country  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Admin $admin, Country $model)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\Domains\ApplicationManagement\Models\Country  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Admin $admin, Country $model)
    {
        return false;
    }
}
