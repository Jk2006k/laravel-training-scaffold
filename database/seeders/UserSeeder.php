<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // TODO Day 4: create 5 users using User::factory()->count(5)->create();
        User::factory()->count(5)->create();
    }
}