<?php

namespace App\Policies;

use App\Domains\Authentication\Models\Admin;
use App\Domains\ApplicationManagement\Models\Category;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
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
        return $admin->hasPermissionTo('view-any-category');
    }

    /**
     * Determine whether the user can view the model.
     *           
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\Domains\ApplicationManagement\Models\Category  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $admin, Category $model)
    {
        return $admin->hasPermissionTo('view-category');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Admin $admin)
    {
        return $admin->hasPermissionTo('create-category');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\Domains\ApplicationManagement\Models\Category  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $admin, Category $model)
    {
        return $admin->hasPermissionTo('update-category');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\Domains\ApplicationManagement\Models\Category  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin, Category $model)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\Domains\ApplicationManagement\Models\Category  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Admin $admin, Category $model)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  \App\Domains\ApplicationManagement\Models\Category  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Admin $admin, Category $model)
    {
        return false;
    }
}
