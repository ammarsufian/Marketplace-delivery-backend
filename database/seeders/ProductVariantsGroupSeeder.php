<?php

namespace Database\Seeders;

use App\Domains\ProductManagement\Models\GroupVariant;
use Illuminate\Database\Seeder;

class ProductVariantsGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GroupVariant::create([
            'type' => 'Group 1',
            'is_required' => false,
        ]);
    }
}
