<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Modules\UserAndLead\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'username' => 'manager',
            'password' => Hash::make('PASSWORD'),
            'role' => 'manager'
        ]);

        User::factory()->create([
            'username' => 'agent',
            'password' => Hash::make('PASSWORD'),
            'role' => 'agent'
        ]);
    }
}
