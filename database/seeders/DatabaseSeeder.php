<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CountryTableSeeder::class);
//        $this->call(CategoryTableSeeder::class);
        $this->call(CityTableSeeder::class);
        $this->call(AdminRolePermissionSeeder::class);
        $this->call(PaymentMethodSeeder::class);
        $this->call(CreditCardCompanySeeder::class);
        $this->call(UserRolePermissionSeeder::class);
        $this->call(OrderCancelReasonSeeder::class);
    }
}
