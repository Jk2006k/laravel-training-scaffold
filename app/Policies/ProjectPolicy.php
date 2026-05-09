<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;

class ProjectPolicy
{
    public function viewAny(User $user): bool
    {
        // TODO Day 9: any logged-in user can view their own project list
        return true;
    }

    public function view(User $user, Project $project): bool
    {
        // TODO Day 9: only the owner OR a team member can view
        return $user->id === $project->user_id || $user->projects()->where('project_id', $project->id)->exists();
    }

    public function create(User $user): bool
    {
        // TODO Day 9: any logged-in user can create projects
        return true;
    }

    public function update(User $user, Project $project): bool
    {
        // TODO Day 9: only the owner can update
        return $user->id === $project->user_id;
    }

    public function delete(User $user, Project $project): bool
    {
        // TODO Day 9: only the owner can delete
        return $user->id === $project->user_id;
    }
}