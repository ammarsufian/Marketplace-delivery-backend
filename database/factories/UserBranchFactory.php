<?php

namespace Database\Factories;

use App\Domains\AccountManagement\Models\Branch;
use App\Domains\AccountManagement\Models\UserBranch;
use App\Domains\Authentication\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserBranchFactory extends Factory
{
    protected $model = UserBranch::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory()->create()->id,
            'branch_id' => Branch::factory()->create()->id,
        ];
    }

    public function ofUser(User $user): self
    {
        return $this->state(function (array $attributes) use ($user) {
            return [
                'user_id' => $user->id
            ];
        });
    }

    public function ofBranch(Branch $branch): self
    {
        return $this->state(function (array $attributes) use ($branch) {
            return [
                'branch_id' => $branch->id
            ];
        });
    }
}
