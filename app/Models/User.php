<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable; 

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        // TODO Day 9: add 'role' here once you create the migration
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // TODO Day 6: define relationships
    //   - projects()      → $this->belongsToMany(Project::class, 'project_user')
    //   - ownedProjects() → $this->hasMany(Project::class)
    //   - assignedTasks() → $this->hasMany(Task::class, 'assigned_to_id')
    
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_user');
    }

    public function ownedProjects()
    {
        return $this->hasMany(Project::class);
    }

    public function assignedTasks()
    {
        return $this->hasMany(Task::class, 'assigned_to_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // TODO Day 10: add HasApiTokens trait (after installing Sanctum)
    //   use Laravel\Sanctum\HasApiTokens;
    //   then add HasApiTokens to the use statement on line 12
}