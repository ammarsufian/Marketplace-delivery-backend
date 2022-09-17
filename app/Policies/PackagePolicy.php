<?php

namespace App\Policies;

use App\Domains\Authentication\Models\Admin;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Domains\ApplicationManagement\Models\Package;

class PackagePolicy
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
        return $admin->hasPermissionTo('view-any-package');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  use App\Domains\ApplicationManagement\Models\Package  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $admin, Package $model)
    {
        return $admin->hasPermissionTo('view-package');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Admin $admin)
    {
        return $admin->hasPermissionTo('create-package');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  use App\Domains\ApplicationManagement\Models\Package  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $admin, Package $model)
    {
        return $admin->hasPermissionTo('update-package');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  use App\Domains\ApplicationManagement\Models\Package  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin, Package $model)
    {
        return $admin->hasPermissionTo('delete-package');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  use App\Domains\ApplicationManagement\Models\Package  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Admin $admin, Package $model)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Domains\Authentication\Models\Admin  $admin
     * @param  use App\Domains\ApplicationManagement\Models\Package  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Admin $admin, Package $model)
    {
        return false;
    }
}
