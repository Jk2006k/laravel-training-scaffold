<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    public function viewAny(User $user): bool
    {
        // TODO Day 9: any logged-in user can view their own task list
        return true;
    }

    public function view(User $user, Task $task): bool
    {
        // TODO Day 9: only the task's project owner OR a project member can view
        return $user->id === $task->project->user_id || $user->projects()->where('project_id', $task->project_id)->exists();
    }

    public function create(User $user): bool
    {
        // TODO Day 9: any logged-in user can create tasks (for their own projects)
        return true;
    }

    public function update(User $user, Task $task): bool
    {
        return $user->id === $task->project->user_id || $user->projects()->where('project_id', $task->project_id)->exists();
    }

    public function delete(User $user, Task $task): bool
    {
        return $user->id === $task->project->user_id || $user->projects()->where('project_id', $task->project_id)->exists();
    }