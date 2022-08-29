<?php

namespace Database\Factories;

use App\Domains\ApplicationManagement\Models\Category;
use App\Domains\ProductManagement\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'category_id' => Category::factory()->create()->id,
            'name' => ['en' => $this->faker->name, 'ar' => $this->faker->name],
            'description' => ['en' => $this->faker->text, 'ar' => $this->faker->text],
        ];
    }

    public function ofCategory(Category $category): ProductFactory
    {
        return $this->state(function (array $attributes) use ($category) {
            return [
                'category_id' => $category->id,
            ];
        });
    }
}
