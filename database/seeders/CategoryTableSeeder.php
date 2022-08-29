<?php

namespace Database\Seeders;

use App\Domains\ApplicationManagement\Models\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create(['name' => ['en' => 'coffee', 'ar' => 'قهوة']]);
        Category::create(['name' => ['en' => 'tools', 'ar' => 'ادوات']]);
        Category::create(['name' => ['en' => 'offers', 'ar' => 'عروض']]);
        Category::create(['name' => ['en' => 'sweets', 'ar' => 'حلويات']]);
        Category::create(['name' => ['en' => 'bakeries', 'ar' => 'مخبوزات']]);
    }
}
