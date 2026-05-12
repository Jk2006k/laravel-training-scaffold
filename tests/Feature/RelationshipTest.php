<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RelationshipTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function project_has_many_tasks()
    {
        // TODO Day 12: create project, attach tasks, assert $project->tasks->count() === N
        $project = Project::factory()->create();
        Task::factory(5)->create(['project_id' => $project->id]);

        $this->assertEquals(5, $project->tasks->count());
        $this->assertEquals(5, Task::where('project_id', $project->id)->count());
    }

    /** @test */
    public function user_belongs_to_many_projects()
    {
        // TODO Day 12: assert $user->projects relationship works (pivot table)
        $user = User::factory()->create();
        $projects = Project::factory(3)->create();

        foreach ($projects as $project) {
            $user->projects()->attach($project);
        }

        $this->assertEquals(3, $user->projects->count());
        $this->assertTrue($user->projects->contains($projects[0]));
    }
}