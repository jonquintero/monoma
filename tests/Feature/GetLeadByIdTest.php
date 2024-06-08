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

    $this->lead = Lead::factory()->create([
        'name' => 'Mi candidato',
        'source' => 'Fotocasa',
        'owner' => $this->agent->id,
        'created_by' => $this->manager->id,
    ]);
});

it('manager can get a lead by id', function () {
    $token = auth('api')->login($this->manager);

    $response = $this->getJson('/api/lead/' . $this->lead->id, ['Authorization' => 'Bearer ' . $token]);

    $response->assertStatus(200)
        ->assertJsonStructure([
            'meta' => ['success', 'errors'],
            'data' => [
                '*' => ['id', 'name', 'source', 'owner', 'created_at', 'created_by']
            ]
        ]);
});

it('agent can get their own lead by id', function () {
    $token = auth('api')->login($this->agent);

    $response = $this->getJson('/api/lead/' . $this->lead->id, ['Authorization' => 'Bearer ' . $token]);

    $response->assertStatus(200)
        ->assertJsonStructure([
            'meta' => ['success', 'errors'],
            'data' => [
                '*' => ['id', 'name', 'source', 'owner', 'created_at', 'created_by']
            ]
        ]);
});

it('agent cannot get another agent lead by id', function () {
    $otherAgent = User::factory()->create([
        'username' => 'other_agent',
        'password' => bcrypt('password'),
        'role' => 'agent',
    ]);

    $token = auth('api')->login($otherAgent);

    $response = $this->getJson('/api/lead/' . $this->lead->id, ['Authorization' => 'Bearer ' . $token]);

    $response->assertStatus(401)
    ->assertJson([
        'meta' => [
            'success' => false,
            'errors' => ['Unauthorized']
        ]
    ]);
});
