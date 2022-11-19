<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserRolePermissionSeeder extends Seeder
{
    protected array $roles = ['application', 'provider', 'driver', 'driver-management', 'manager','super-admin','guest'];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createRoles();
    }

    protected function createRoles()
    {
        collect($this->roles)->each(function ($role) {
            Role::updateOrCreate(['name' => $role, 'guard_name' => 'web']);
        });
    }
}
