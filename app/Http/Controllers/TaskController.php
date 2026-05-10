<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

class TaskController extends Controller
{
    public function index(Project $project)
    {
        $project->load('tasks.comments', 'tasks.assignee');
        return view('tasks.index', ['project' => $project, 'tasks' => $project->tasks]);
    }

    public function create(Project $project)
    {
        return view('tasks.create', ['project' => $project]);
    }

    public function store(StoreTaskRequest $request, Project $project)
    {
        // TODO Day 5: $project->tasks()->create([...]);
        // TODO Day 7: use StoreTaskRequest
        // TODO Day 11: handle file upload — Storage::disk('public')->put(...)
        $validated = $request->validated();
        $validated['project_id'] = $project->id;
        
        $task = Task::create($validated);

        return redirect()->route('projects.tasks.show', [$project, $task])
                        ->with('success', 'Task created successfully');
    }

    public function show(Project $project, Task $task)
    {
        // TODO Day 5: return view('tasks.show', ['task' => $task]);
        $task->load('project', 'comments.user', 'assignee');
        return view('tasks.show', ['task' => $task]);
    }   

    public function edit(Project $project, Task $task)
    {
        // TODO Day 5: return view('tasks.edit', ['task' => $task]);
        // TODO Day 9: $this->authorize('update', $task);
        $this->authorize('update', $task);
        return view('tasks.edit', ['task' => $task, 'project' => $project]);
    }

    public function update(UpdateTaskRequest $request, Project $project, Task $task)
    {
        // TODO Day 5: $task->update([...]);
        // TODO Day 7: use UpdateTaskRequest
        // TODO Day 9: $this->authorize('update', $task);
        // TODO Day 11: when assigned_to_id changes, dispatch TaskAssigned mail (queued)
        $this->authorize('update', $task);
        $task->update($request->validated());

        return redirect()->route('projects.tasks.show', [$project, $task])
                        ->with('success', 'Task updated successfully');
    }

    public function destroy(Project $project, Task $task)
    {
        // TODO Day 5: $task->delete();
        // TODO Day 9: $this->authorize('delete', $task);
        $this->authorize('delete', $task);
        $task->delete();

        return redirect()->route('projects.tasks.index', $project)
                        ->with('success', 'Task deleted successfully');
    }
}