<?php

namespace Database\Factories;

use App\Domains\Authentication\Models\User;
use App\Domains\ProductManagement\Models\EntityProduct;
use App\Domains\ProductManagement\Models\Favorite;
use Illuminate\Database\Eloquent\Factories\Factory;

class FavoriteFactory extends Factory
{
    protected $model = Favorite::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'entity_product_id' => EntityProduct::factory()->create()->id,
            'user_id' => User::factory()->create()->id
        ];
    }

    public function ofUser(User $user): FavoriteFactory
    {
        return $this->state(function (array $attributes) use ($user) {
            return [
                'user_id' => $user->id
            ];
        });
    }
}
