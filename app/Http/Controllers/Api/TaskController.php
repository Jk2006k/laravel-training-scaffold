<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\TaskResource;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    public function index(Request $request, Project $project)
    {
        // TODO Day 10: Return tasks for a specific project
        $this->authorize('view', $project);
        $tasks = $project->tasks()->get();
        return TaskResource::collection($tasks);
    }

    public function store(Request $request, Project $project)
    {
        // TODO Day 10: Create new task in project
        $this->authorize('create', Task::class);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|string|in:todo,in_progress,done',
            'due_date' => 'nullable|date',
            'assigned_to_id' => 'nullable|integer|exists:users,id',
        ]);

        $task = $project->tasks()->create($validated);
        return (new TaskResource($task))->response()->setStatusCode(201);
    }

    public function show(Request $request, Project $project, Task $task)
    {
        // TODO Day 10: Show specific task (with authorization)
        $this->authorize('view', $task);
        return new TaskResource($task);
    }

    public function update(Request $request, Project $project, Task $task)
    {
        // TODO Day 10: Update task (with authorization)
        $this->authorize('update', $task);
        
        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|string|in:todo,in_progress,done',
            'due_date' => 'nullable|date',
            'assigned_to_id' => 'nullable|integer|exists:users,id',
        ]);

        $task->update($validated);
        return new TaskResource($task);
    }

    public function destroy(Request $request, Project $project, Task $task)
    {
        // TODO Day 10: Delete task (with authorization)
        $this->authorize('delete', $task);
        $task->delete();
        return response()->json(['message' => 'Task deleted successfully']);
    }
}
