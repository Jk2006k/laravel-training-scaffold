<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['body', 'user_id', 'task_id'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // TODO Day 5: define $fillable — body, user_id, task_id

    // TODO Day 6: define relationships
    //   - task() → $this->belongsTo(Task::class)
    //   - user() → $this->belongsTo(User::class)
    
    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}