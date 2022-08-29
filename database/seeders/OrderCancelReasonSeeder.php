<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Domains\OrderManagement\Models\OrderCancelReason;

class OrderCancelReasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
    
        OrderCancelReason::updateOrCreate(
            ['slug' => Str::slug('Product is not available')],
            ['reason' => ['en' =>'Product is not available', 'ar' => 'المنتج غير متوفر',
            'slug' => Str::slug('Product is not available')]
        ]);
        OrderCancelReason::updateOrCreate(
            ['slug' => Str::slug('Working time is over')],
            ['reason' => ['en' =>'Working time is over' , 'ar' => 'انتهى وقت العمل'],
            'slug' => Str::slug('Working time is over')
        ]);
        OrderCancelReason::updateOrCreate(
            ['slug' => Str::slug('The chef is not available')],
            ['reason' => ['en' =>'The chef is not available' , 'ar' => 'الشيف غير متوفر'],
            'slug' => Str::slug('The chef is not available')
        ]);
        OrderCancelReason::updateOrCreate(
            ['slug' => Str::slug('There are a lots of orders')],
            ['reason' => ['en' =>'There are a lots of orders' , 'ar' => 'عدد الطلبات كثير'],
            'slug' => Str::slug('There are a lots of orders')
        ]);
        OrderCancelReason::updateOrCreate(
            ['slug' => Str::slug('order notes are not enforceable')],
            ['reason' => ['en' =>'order notes are not enforceable' , 'ar' => 'لا يمكن تنفيذ الملاحظات'],
            'slug' => Str::slug('order notes are not enforceable')
        ]);
        OrderCancelReason::updateOrCreate(
            ['slug' => Str::slug('Other')],
            ['reason' => ['en' =>'Other' , 'ar' => 'أخرى'],
            'slug' => Str::slug('Other')
        ]);
    }
}
