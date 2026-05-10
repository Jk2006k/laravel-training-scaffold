<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        // TODO Day 10: Return projects for authenticated user
        $projects = $request->user()->ownedProjects()->get();
        return ProjectResource::collection($projects);
    }

    public function store(Request $request)
    {
        // TODO Day 10: Create new project
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|string|in:pending,in_progress,completed',
        ]);

        $project = $request->user()->ownedProjects()->create($validated);
        return (new ProjectResource($project))->response()->setStatusCode(201);
    }

    public function show(Project $project)
    {
        // TODO Day 10: Show specific project (with authorization)
        $this->authorize('view', $project);
        return new ProjectResource($project);
    }

    public function update(Request $request, Project $project)
    {
        // TODO Day 10: Update project (with authorization)
        $this->authorize('update', $project);
        
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|string|in:pending,in_progress,completed',
        ]);

        $project->update($validated);
        return new ProjectResource($project);
    }

    public function destroy(Project $project)
    {
        // TODO Day 10: Delete project (with authorization)
        $this->authorize('delete', $project);
        $project->delete();
        return response()->json(['message' => 'Project deleted successfully']);
    }
}
