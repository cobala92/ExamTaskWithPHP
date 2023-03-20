<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        $users = \App\Models\User::pluck('id')->toArray();
        return [
            'title' => fake()->title(),
            'description' => Str::random(10),
            'numbers' => rand(2, 50),
            'status' => rand(2, 50),
            'start_date' => now()->toDateString(),
            'due_date' => now()->toDateString(),
            'assignee' => fake()->randomElement($users),
            'estimate' => rand(2.2, 3.3),
            'actual' => rand(2.5, 3.3),
        ];
    }
}
