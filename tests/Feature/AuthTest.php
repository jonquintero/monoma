<?php

use Modules\UserAndLead\Models\User;

it('can generate an access token', function () {
    $user = User::factory()->create([
        'username' => 'tester',
        'password' => bcrypt('PASSWORD'),
    ]);

    $response = $this->postJson('/api/auth', [
        'username' => 'tester',
        'password' => 'PASSWORD',
    ]);

    $response->assertStatus(200)
        ->assertJsonStructure([
            'meta' => ['success', 'errors'],
            'data' => ['token', 'minutes_to_expire']
        ]);
});

it('returns unauthorized with invalid credentials', function () {
    $response = $this->postJson('/api/auth', [
        'username' => 'tester',
        'password' => 'wrongpassword',
    ]);

    $response->assertStatus(401)
        ->assertJson([
            'meta' => [
                'success' => false,
                'errors' => ['Password incorrect for: tester']
            ]
        ]);
});
