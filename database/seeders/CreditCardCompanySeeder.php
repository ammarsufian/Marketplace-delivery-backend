<?php

namespace Database\Seeders;

use App\Domains\Transaction\Models\CreditCardCompany;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CreditCardCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CreditCardCompany::updateOrCreate(['slug' => Str::slug('visa')],[
            'slug' =>Str::slug('visa'),
            'name' => ['en' => 'Visa','ar'=> 'Visa']
        ]);

        CreditCardCompany::updateOrCreate(['slug' => Str::slug('master-card')],[
            'slug' =>Str::slug('master-card'),
            'name' => ['en' => 'Master Card','ar'=> 'Master Card']
        ]);
    }
}
