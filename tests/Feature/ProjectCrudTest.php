<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectCrudTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function authenticated_user_can_view_their_projects()
    {
        // TODO Day 12: actingAs($user)->get('/projects') → assertOk(), assertSee($project->name)
        $user = User::factory()->create();
        $project = Project::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->get('/projects');
        
        $response->assertOk();
        $response->assertSee($project->name);
    }

    /** @test */
    public function authenticated_user_can_create_a_project()
    {
        // TODO Day 12: actingAs($user)->post('/projects', [...]) → assertRedirect(), assertDatabaseHas(...)
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/projects', [
            'name' => 'New Project',
            'description' => 'A test project',
            'status' => 'active',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('projects', [
            'name' => 'New Project',
            'user_id' => $user->id,
        ]);
    }

    /** @test */
    public function user_cannot_update_another_users_project()
    {
        // TODO Day 12: ensures Day 9 policies work — actingAs($otherUser)->put(...) → assertForbidden()
        $owner = User::factory()->create();
        $otherUser = User::factory()->create();
        $project = Project::factory()->create(['user_id' => $owner->id]);

        $response = $this->actingAs($otherUser)->put("/projects/{$project->id}", [
            'name' => 'Updated Name',
            'description' => 'Updated description',
            'status' => 'completed',
        ]);

        $response->assertForbidden();
    }

    /** @test */
    public function owner_can_update_their_project()
    {
        // TODO Day 12: add 2 more tests covering update + delete for the owner
        $user = User::factory()->create();
        $project = Project::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->put("/projects/{$project->id}", [
            'name' => 'Updated Project Name',
            'description' => 'Updated description',
            'status' => 'completed',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('projects', [
            'id' => $project->id,
            'name' => 'Updated Project Name',
        ]);
    }

    /** @test */
    public function owner_can_delete_their_project()
    {
        // TODO Day 12: add 2 more tests covering update + delete for the owner
        $user = User::factory()->create();
        $project = Project::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->delete("/projects/{$project->id}");

        $response->assertRedirect();
        $this->assertDatabaseMissing('projects', [
            'id' => $project->id,
        ]);
    }
}