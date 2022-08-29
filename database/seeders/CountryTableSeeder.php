<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\WithFaker;
use App\Domains\ApplicationManagement\Models\Country;

class CountryTableSeeder extends Seeder
{
    use WithFaker;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::updateOrCreate(
            ['slug' => Str::slug('Saudi Arabia')],
            ['name' => ['en' => 'Saudi Arabia', 'ar' => 'السعودية'], 
            'slug' => Str::slug('Saudi Arabia')]
        );
    }
}
