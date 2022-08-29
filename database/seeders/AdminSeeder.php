<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Domains\Authentication\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        Admin::updateOrCreate(['name' => 'Admin',
            'password' => Hash::make('password'),
            'email' => 'admin@cova-app.com',
        ])->first()->assignRole('super-admin');
    }
}
