<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        // TODO Day 4: create 50 comments distributed across the existing tasks
        \App\Models\Comment::factory()->count(50)->create();
    }
}