<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\UserAndLead\Models\User;
use Modules\UserAndLead\Models\Lead;

beforeEach(function () {
    $this->manager = User::factory()->create([
        'username' => 'manager',
        'password' => bcrypt('password'),
        'role' => 'manager',
    ]);

    $this->agent = User::factory()->create([
        'username' => 'agent',
        'password' => bcrypt('password'),
        'role' => 'agent',
    ]);
});

it('manager can create a lead', function () {
    $token = auth('api')->login($this->manager);

    $response = $this->postJson('/api/lead', [
        'name' => 'Mi candidato',
        'source' => 'Fotocasa',
        'owner' => $this->agent->id
    ], ['Authorization' => 'Bearer ' . $token]);

    $response->assertStatus(201)
        ->assertJsonStructure([
            'meta' => ['success', 'errors'],
            'data' => [
                '*' => ['id', 'name', 'source', 'owner', 'created_at', 'created_by']
            ]
        ]);
});

it('agent cannot create a lead', function () {
    $token = auth('api')->login($this->agent);

    $response = $this->postJson('/api/lead', [
        'name' => 'Mi candidato',
        'source' => 'Fotocasa',
        'owner' => $this->agent->id
    ], ['Authorization' => 'Bearer ' . $token]);

    $response->assertStatus(401)
        ->assertJson([
            'meta' => [
                'success' => false,
                'errors' => ['Token expired']
            ]
        ]);
});
