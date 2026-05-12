<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiAuthTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_login_and_receive_a_token()
    {
        // TODO Day 12: POST /api/login with credentials → assertJsonStructure(['token'])
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $response->assertOk()
            ->assertJsonStructure([
                'message',
                'user' => ['id', 'name', 'email', 'role'],
                'token',
            ]);
    }

    /** @test */
    public function authenticated_request_returns_user_projects()
    {
        // TODO Day 12: GET /api/projects with bearer token → assertOk(), assertJsonCount(...)
        $user = User::factory()->create();
        Project::factory(3)->create(['user_id' => $user->id]);

        $token = $user->createToken('API Token')->plainTextToken;

        $response = $this->withHeader('Authorization', "Bearer $token")
            ->getJson('/api/projects');

        $response->assertOk();
    }
}