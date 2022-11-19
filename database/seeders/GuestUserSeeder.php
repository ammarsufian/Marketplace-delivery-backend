<?php

namespace Database\Seeders;

use App\Domains\ApplicationManagement\Models\Country;
use App\Domains\Authentication\Models\User;
use Illuminate\Database\Seeder;

class GuestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'guest',
            'email' => 'guest@cova.com',
            'mobile_number' => '9627897889789',
            'country_id' => Country::SAUDIA_COUNTRY_ID,
        ])->assignRole('guest');
    }
}
