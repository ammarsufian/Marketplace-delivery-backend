<?php

namespace App\Policies;

use App\Domains\Authentication\Models\Admin;
use App\Domains\Transaction\Models\Transaction;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransactionPolicy
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
        return $admin->hasPermissionTo('view-any-transaction');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\Domains\Transaction\Models\Transaction  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $admin, Transaction $model)
    {
        return $admin->hasPermissionTo('view-transaction');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Admin $admin)
    {
        return $admin->hasPermissionTo('create-transaction');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\Domains\Transaction\Models\Transaction  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $admin, Transaction $model)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\Domains\Transaction\Models\Transaction  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin, Transaction $model)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\Domains\Transaction\Models\Transaction  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Admin $admin, Transaction $model)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\Domains\Transaction\Models\Transaction  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Admin $admin, Transaction $model)
    {
        return false;
    }
}
