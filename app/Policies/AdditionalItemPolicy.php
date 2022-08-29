<?php

namespace App\Policies;
use App\Domains\Authentication\Models\Admin;
use App\Domains\ProductManagement\Models\AdditionalItem;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdditionalItemPolicy
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
     * @param  \App\Domains\ProductManagement\Models\AdditionalItem  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $admin, AdditionalItem $model)
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
        return  false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\Domains\ProductManagement\Models\AdditionalItem $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $admin, AdditionalItem $model)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\Domains\ProductManagement\Models\AdditionalItem $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin, AdditionalItem $model)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\Domains\ProductManagement\Models\AdditionalItem $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Admin $admin, AdditionalItem $model)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\Domains\ProductManagement\Models\AdditionalItem $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Admin $admin, AdditionalItem $model)
    {
        return false;
    }
}
