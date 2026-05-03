<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        // TODO Day 4: create 30 tasks distributed across the existing projects
        \App\Models\Task::factory()->count(30)->create();
    }
}