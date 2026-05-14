<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Mail\TaskAssigned;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

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
        
        // Handle file upload
        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('task-attachments', 'public');
            $validated['attachment_path'] = $path;
        }
        
        $task = Task::create($validated);
        
        // Send email if task was assigned to someone on creation
        if ($task->assigned_to_id !== null) {
            try {
                $task->load('project', 'assignee');
                Mail::send(new TaskAssigned($task));
            } catch (\Exception $e) {
                \Log::error('Failed to send task assignment email: ' . $e->getMessage());
            }
        }

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
        $validated = $request->validated();
        
        // Handle file upload
        if ($request->hasFile('attachment')) {
            // Delete old attachment if exists
            if ($task->attachment_path) {
                Storage::disk('public')->delete($task->attachment_path);
            }
            $path = $request->file('attachment')->store('task-attachments', 'public');
            $validated['attachment_path'] = $path;
        }
        
        // Check if assigned_to_id changed and dispatch email
        $oldAssignedToId = $task->assigned_to_id;
        $newAssignedToId = $validated['assigned_to_id'] ?? null;
        
        $task->update($validated);
        
        // Dispatch email if task was newly assigned
        if ($oldAssignedToId !== $newAssignedToId && $newAssignedToId !== null) {
            try {
                // Load relationships before sending
                $task->load('project', 'assignee');
                Mail::send(new TaskAssigned($task));
            } catch (\Exception $e) {
                \Log::error('Failed to send task assignment email: ' . $e->getMessage());
            }
        }

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