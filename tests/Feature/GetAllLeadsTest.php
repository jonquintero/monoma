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

    $this->lead1 = Lead::factory()->create([
        'name' => 'Mi candidato 1',
        'source' => 'Fotocasa',
        'owner' => $this->agent->id,
        'created_by' => $this->manager->id,
    ]);

    $this->lead2 = Lead::factory()->create([
        'name' => 'Mi candidato 2',
        'source' => 'Habitaclia',
        'owner' => $this->agent->id,
        'created_by' => $this->manager->id,
    ]);
});

it('manager can get all leads', function () {
    $token = auth('api')->login($this->manager);

    $response = $this->getJson('/api/leads', ['Authorization' => 'Bearer ' . $token]);

    $response->assertStatus(200)
        ->assertJsonStructure([
            'meta' => ['success', 'errors'],
            'data' => [
                '*' => [
                    '*' => ['id', 'name', 'source', 'owner', 'created_at', 'created_by']
                ]
            ]
        ]);
});

it('agent can get only their leads', function () {
    $token = auth('api')->login($this->agent);

    $response = $this->getJson('/api/leads', ['Authorization' => 'Bearer ' . $token]);

    $response->assertStatus(200)
        ->assertJsonStructure([
            'meta' => ['success', 'errors'],
            'data' => [
                '*' => [
                    '*' => ['id', 'name', 'source', 'owner', 'created_at', 'created_by']
                ]
            ]
        ]);
});
