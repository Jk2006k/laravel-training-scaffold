<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        // TODO Day 2 (stub): return a placeholder string
        // TODO Day 5: replace with — return view('projects.index', ['projects' => Project::all()]);
        // TODO Day 6: add eager loading — Project::with('tasks')->get() — to fix N+1
        // TODO Day 8: scope to logged-in user — auth()->user()->projects
        return 'Projects index stub - Day 2';
    }

    public function create()
    {
        // TODO Day 2 (stub) → Day 5: return view('projects.create');
        return 'Projects create stub - Day 2';
    }

    public function store(Request $request)
    {
        // TODO Day 5: validate inline with $request->validate([...]), then Project::create([...])
        // TODO Day 7: replace Request with StoreProjectRequest (Form Request)
        // TODO Day 8: associate with auth()->user() before creating
        abort(501, 'TODO Day 5 — implement store');
    }

    public function show(Project $project)
    {
        // TODO Day 5: return view('projects.show', ['project' => $project]);
        // TODO Day 6: load relationships — $project->load('tasks.comments', 'members');
        // TODO Day 9: $this->authorize('view', $project);
        abort(501, 'TODO Day 5 — implement show');
    }

    public function edit(Project $project)
    {
        // TODO Day 5: return view('projects.edit', ['project' => $project]);
        // TODO Day 9: $this->authorize('update', $project);
        abort(501, 'TODO Day 5 — implement edit');
    }

    public function update(Request $request, Project $project)
    {
        // TODO Day 5: $project->update([...]) then redirect
        // TODO Day 7: replace Request with UpdateProjectRequest
        // TODO Day 9: $this->authorize('update', $project);
        abort(501, 'TODO Day 5 — implement update');
    }

    public function destroy(Project $project)
    {
        // TODO Day 5: $project->delete() then redirect
        // TODO Day 9: $this->authorize('delete', $project);
        abort(501, 'TODO Day 5 — implement destroy');
    }
}