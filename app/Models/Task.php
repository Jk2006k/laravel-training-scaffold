<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'status', 'due_date', 'project_id', 'assigned_to_id'];

    protected $casts = [
        'due_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // TODO Day 5: define $fillable — title, description, status, due_date, project_id, assigned_to_id

    // TODO Day 6: define relationships
    //   - project()  → $this->belongsTo(Project::class)
    //   - comments() → $this->hasMany(Comment::class)
    //   - assignee() → $this->belongsTo(User::class, 'assigned_to_id')
    
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assigned_to_id');
    }
}