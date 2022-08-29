<?php

namespace App\Policies;

use App\Domains\Transaction\Models\CreditCardCompany;
use App\Domains\Authentication\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class CreditCardCompanyPolicy
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
        return $admin->hasPermissionTo('view-any-credit-card-company');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \pp\Domains\Transaction\Models\CreditCardCompany  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $admin, CreditCardCompany $model)
    {
        return $admin->hasPermissionTo('view-credit-card-company');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Admin $admin)
    {
        return $admin->hasPermissionTo('create-credit-card-company');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \pp\Domains\Transaction\Models\CreditCardCompany  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $admin, CreditCardCompany $model)
    {
        return $admin->hasPermissionTo('update-credit-card-company');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \pp\Domains\Transaction\Models\CreditCardCompany  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin, CreditCardCompany $model)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \pp\Domains\Transaction\Models\CreditCardCompany  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Admin $admin, CreditCardCompany $model)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \pp\Domains\Transaction\Models\CreditCardCompany  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Admin $admin, CreditCardCompany $model)
    {
        return false;
    }
}
