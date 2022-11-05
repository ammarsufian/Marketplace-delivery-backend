<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    /**
     * Run the database seeds.
     *
     * @return void
     */

    protected array $roles = ['super-admin', 'operation'];

    protected array $abilities = ['view', 'create', 'update', 'delete', 'view-any'];
    protected array $permissions = [''];

    protected array $resources = [
        'additional-item', 'address',
        'branch', 'brand', 'cart',
        'cart-item', 'cart-item-variant',
        'category', 'city', 'country',
        'entity-product', 'order', 'order-item',
        'order-item-variant', 'product',
        'promo-code', 'user', 'variant',
        'variant-group','role', 'permission','admin',
        'credit-card-company', 'credit-card',
        'entity-product-additional-item',
        'entity-product-variants',
        'payment-method','transaction','order-cancel-reason',
        'new-joiner','contact-us','user-branch','package'
    ];


    public function run()
    {
        $this->createRoles();
        $this->createPermissions();
        $this->attachPermissionsToRoles();
    }

    protected function createRoles()
    {
        collect($this->roles)->each(function ($role) {
            Role::updateOrCreate(['name' => $role, 'guard_name' => 'admins']);
        });

    }

    protected function createPermissions()
    {
        collect($this->resources)->each(function ($resource) {
            collect($this->abilities)->each(function ($abilitie) use ($resource) {
                Permission::updateOrCreate(['name' => $this->getPermissionName($abilitie, $resource)], ['guard_name' => 'admins']);
            });
        });

    }

    protected function attachPermissionsToRoles()
    {
        /**
         * @var $admin|array super-admin role permissions only
         */
        $admin = [
            'view-any-address', 'view-address',
            'view-any-cart', 'view-cart',
            'view-any-cart-item', 'view-cart-item',
            'view-any-cart-item-variant', 'view-cart-item-variant',
            'view-any-order', 'view-order','create-order','update-order',
            'view-any-order-item', 'view-order-item',
            'view-any-order-item-variant', 'view-order-item-variant',
            'view-any-user', 'view-user', 'create-user', 'update-user',
            'view-any-role','view-role' ,'create-role',
            'view-any-permission', 'view-permission',
            'view-any-admin','view-admin', 'create-admin', 'update-admin',
            'view-any-credit-card-company', 'view-credit-card-company',
            'create-credit-card-company', 'update-credit-card-company',
            'view-any-entity-product-additional-item',
            'view-entity-product-additional-item',
            'create-entity-product-additional-item',
            'update-entity-product-additional-item',
            'view-any-entity-product-variants',
            'view-entity-product-variants',
            'create-entity-product-variants',
            'update-entity-product-variants',
            'view-any-payment-method', 'view-payment-method',
            'create-payment-method', 'update-payment-method',
            'view-any-transaction', 'view-transaction',
            'create-transaction', 'update-transaction',
            'update-order-cancel-reason','create-order-cancel-reason','delete-contact-us',
        ];

        /**
         * @var $operation array permissions shared between super-admin role and `operation` role
         */
        $operation = [
            'view-any-additional-item', 'view-additional-item', 'create-additional-item', 'update-additional-item',
            'view-any-branch', 'view-branch', 'create-branch', 'update-branch',
            'view-any-brand', 'view-brand', 'create-brand', 'update-brand',
            'view-any-category', 'view-category', 'create-category', 'update-category',
            'view-any-city', 'view-city', 'create-city', 'update-city',
            'view-any-country', 'view-country', 'create-country', 'update-country',
            'view-any-entity-product', 'view-entity-product', 'create-entity-product', 'update-entity-product',
            'view-any-product', 'view-product', 'create-product', 'update-product',
            'view-any-promo-code', 'view-promo-code', 'create-promo-code', 'update-promo-code',
            'view-any-variant', 'view-variant', 'create-variant', 'update-variant',
            'view-any-variant-group', 'view-variant-group', 'create-variant-group', 'update-variant-group',
            'view-any-new-joiner', 'view-new-joiner', 'update-new-joiner',
            'view-any-contact-us', 'view-contact-us',
            'view-any-order-cancel-reason', 'view-order-cancel-reason',
            'view-any-user-branch', 'view-user-branch','create-user-branch','update-user-branch',
            'view-any-package', 'view-package', 'create-package', 'update-package',
        ];

        Role::where('name', 'super-admin')
            ->first()
            ->syncPermissions(array_merge($admin, $operation));

        Role::where('name', 'operation')
            ->first()
            ->syncPermissions($operation);
    }

    protected function getPermissionName($abilitie, $resource): string
    {
        return "$abilitie-$resource";
    }
}
