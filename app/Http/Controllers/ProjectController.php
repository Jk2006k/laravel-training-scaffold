<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

class ProjectController extends Controller
{
    public function index()
    {
        // TODO Day 2 (stub): return a placeholder string
        // Day 3: return the view with hardcoded dummy data
        // TODO Day 5: replace with — return view('projects.index', ['projects' => Project::all()]);
        // TODO Day 6: add eager loading — Project::with('tasks')->get() — to fix N+1
        // Day 8: scope to logged-in user — auth()->user()->projects
        return view('projects.index', ['projects' => auth()->user()->ownedProjects()->with('owner', 'tasks', 'members')->get()]);
    }

    public function create()
    {
        // TODO Day 2 (stub) → Day 5: return view('projects.create');
        return view('projects.create');
    }

    public function store(StoreProjectRequest $request)
    {
        // TODO Day 5: validate inline with $request->validate([...]), then Project::create([...])
        // TODO Day 7: replace Request with StoreProjectRequest (Form Request)
        // Day 8: associate with auth()->user() before creating
        $validated = $request->validated();

        $validated['user_id'] = auth()->user()->id;

        Project::create($validated);

        return redirect()->route('projects.index')->with('success', 'Project created successfully');
    }

    public function show(Project $project)
    {
        // TODO Day 2 (stub): temporary — just testing the route works or not !!!
        // Day 3: return the view with hardcoded dummy data
        // TODO Day 5: return view('projects.show', ['project' => $project]);
        // TODO Day 6: load relationships — $project->load('tasks.comments', 'members');
        // TODO Day 9: $this->authorize('view', $project);
        $project->load('owner', 'tasks.comments', 'tasks.assignee', 'members');
        return view('projects.show', ['project' => $project]);
    }

    public function edit(Project $project)
    {
        // TODO Day 5: return view('projects.edit', ['project' => $project]);
        // TODO Day 9: $this->authorize('update', $project);
        return view('projects.edit', ['project' => $project]);
    }

    public function update(UpdateProjectRequest $request, Project $project)
    {
        // TODO Day 5: $project->update([...]) then redirect
        // TODO Day 7: replace Request with UpdateProjectRequest
        // TODO Day 9: $this->authorize('update', $project);
        $validated = $request->validated();

        $project->update($validated);

        return redirect()->route('projects.show', $project->id)->with('success', 'Project updated successfully');
    }

    public function destroy(Project $project)
    {
        // TODO Day 5: $project->delete() then redirect
        // TODO Day 9: $this->authorize('delete', $project);
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project deleted successfully');
    }
}