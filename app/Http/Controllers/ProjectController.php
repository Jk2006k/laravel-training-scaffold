<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        // TODO Day 2 (stub): return a placeholder string
        // Day 3: return the view with hardcoded dummy data
        // TODO Day 5: replace with — return view('projects.index', ['projects' => Project::all()]);
        // TODO Day 6: add eager loading — Project::with('tasks')->get() — to fix N+1
        // TODO Day 8: scope to logged-in user — auth()->user()->projects
        return view('projects.index', ['projects' => Project::with('owner', 'tasks', 'members')->get()]);
    }

    public function create()
    {
        // TODO Day 2 (stub) → Day 5: return view('projects.create');
        return view('projects.create');
    }

    public function store(Request $request)
    {
        // TODO Day 5: validate inline with $request->validate([...]), then Project::create([...])
        // TODO Day 7: replace Request with StoreProjectRequest (Form Request)
        // TODO Day 8: associate with auth()->user() before creating
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|string|in:active,pending,completed',
        ]);

        $validated['user_id'] = User::first()->id ?? 1;

        Project::create($validated);

        return redirect()->route('projects.index')->with('success', 'Project created successfully');
    }

    public function show($id)
    {
        // TODO Day 2 (stub): temporary — just testing the route works or not !!!
        // Day 3: return the view with hardcoded dummy data
        // TODO Day 5: return view('projects.show', ['project' => $project]);
        // TODO Day 6: load relationships — $project->load('tasks.comments', 'members');
        // TODO Day 9: $this->authorize('view', $project);
        $project = Project::with('owner', 'tasks.comments', 'tasks.assignee', 'members')->findOrFail($id);
        return view('projects.show', ['project' => $project]);
    }

    public function edit(Project $project)
    {
        // TODO Day 5: return view('projects.edit', ['project' => $project]);
        // TODO Day 9: $this->authorize('update', $project);
        return view('projects.edit', ['project' => $project]);
    }

    public function update(Request $request, Project $project)
    {
        // TODO Day 5: $project->update([...]) then redirect
        // TODO Day 7: replace Request with UpdateProjectRequest
        // TODO Day 9: $this->authorize('update', $project);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|string|in:active,pending,completed',
        ]);

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