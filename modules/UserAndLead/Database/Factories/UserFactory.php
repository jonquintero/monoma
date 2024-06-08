<?php

namespace Modules\UserAndLead\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Modules\UserAndLead\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Modules\UserAndLead\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'username' => fake()->unique()->userName,
            'password' => static::$password ??= Hash::make('password'),
            'last_login' => now(),
            'is_active' => true,
            'role' => fake()->randomElement(['manager', 'agent']),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
