<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        // TODO Day 4: create 10 projects using Project::factory()->count(10)->create();
        \App\Models\Project::factory()->count(10)->create();
    }
}