<?php

namespace Modules\UserAndLead\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\UserAndLead\Models\Lead;
use Modules\UserAndLead\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Modules\UserAndLead\Models\Lead>
 */
class LeadFactory extends Factory
{
    protected $model = Lead::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'source' => $this->faker->randomElement(['Fotocasa', 'Habitaclia']),
            'owner' => User::factory(),
            'created_by' => User::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
