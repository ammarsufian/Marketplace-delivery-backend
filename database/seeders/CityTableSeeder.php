<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Domains\ApplicationManagement\Models\City;
use App\Domains\ApplicationManagement\Models\Country;
use Illuminate\Support\Str;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {                   
        City::updateOrCreate(
            ['slug'=>'Riyadh'],
            ['name' => ['en' => 'Riyadh', 'ar' => 'الرياض'], 
            'country_id' => Country::SAUDIA_COUNTRY_ID,
            'slug'=>'Riyadh'
        ]);
        
        City::updateOrCreate(
            ['slug'=>'Jeddah'],
            ['name' => ['en' => 'Jeddah', 'ar' => 'جدة'], 
            'country_id' => Country::SAUDIA_COUNTRY_ID,
            'slug'=>'Jeddah'
            ]);

        City::updateOrCreate(
            ['slug' => Str::slug('Makkah')],
            ['name' => ['en' => 'Makkah', 'ar' => 'مكة المكرمة'], 
            'country_id' => Country::SAUDIA_COUNTRY_ID,
            'slug' => Str::slug('Makkah')
        ]);

        City::updateOrCreate(
            ['slug' => Str::slug('Medina')],
            ['name' => ['en' => 'Medina', 'ar' => 'المدينة المنورة'],
            'country_id' => Country::SAUDIA_COUNTRY_ID,
            'slug'=>'Medina'
        ]);

        City::updateOrCreate(
            ['slug' => Str::slug('Dammam')],
            ['name' => ['en' => 'Dammam', 'ar' => 'الدمام'], 
            'country_id' => Country::SAUDIA_COUNTRY_ID,
            'slug'=>'Dammam'
        ]);

        City::updateOrCreate(
            ['slug'=>'Tabuk'],
            ['name' => ['en' => 'Tabuk', 'ar' => 'تبوك'], 
            'country_id' => Country::SAUDIA_COUNTRY_ID,
            'slug'=>'Tabuk'
        ]);

        City::updateOrCreate(
            ['slug'=>'Al-Ahsa'],
            ['name' => ['en' => 'Al-Ahsa', 'ar' => 'الأحساء'], 
            'country_id' => Country::SAUDIA_COUNTRY_ID,
            'slug'=>'Al-Ahsa'
        ]);

        City::updateOrCreate(
            ['slug'=>'Al-Butayn'],
            ['name' => ['en' => 'Al-Butayn', 'ar' => 'البطين'], 
            'country_id' => Country::SAUDIA_COUNTRY_ID,
            'slug'=>'Al-Butayn'
        ]);

        City::updateOrCreate(
            ['slug'=>'Taif'],
            ['name' => ['en' => 'Taif', 'ar' => 'الطائف'], 
            'country_id' => Country::SAUDIA_COUNTRY_ID,
            'slug'=>'Taif'
        ]);

        City::updateOrCreate(
            ['slug'=>'AL-Qassim'],
            ['name' => ['en' => 'Al-Qassim', 'ar' => 'القصيم'], 
            'country_id' => Country::SAUDIA_COUNTRY_ID,
            'slug'=>'Al-Qassim'
        ]);
    }
}
