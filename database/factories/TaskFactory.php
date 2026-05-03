<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'status' => fake()->randomElement(['todo', 'in_progress', 'completed']),
            'due_date' => fake()->dateTimeBetween('+1 week', '+3 months')->format('Y-m-d'),
            'project_id' => Project::factory(),
            'assigned_to_id' => User::inRandomOrder()->first()?->id,
        ];
    }
}
