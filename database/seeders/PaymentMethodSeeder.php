<?php

namespace Database\Seeders;

use App\Domains\Transaction\Models\PaymentMethod;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentMethod::updateOrCreate(['slug' => Str::slug('online')], [
            'name' => ['en' => 'online', 'ar' => 'online'],
            'is_active' => true,
        ]);

        PaymentMethod::updateOrCreate(['slug' => Str::slug('cash on delivery')], [
            'name' => ['en' => 'cash on delivery', 'ar' => 'cash on delivery'],
            'is_active' => true,
        ]);

        PaymentMethod::updateOrCreate(['slug' => Str::slug('points')], [
            'name' => ['en' => 'points', 'ar' => 'points'],
            'is_active' => true,
        ]);
    }
}
