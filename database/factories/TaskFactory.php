<?php

namespace Database\Factories;

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
        $verbs = ['Complete', 'Implement', 'Design', 'Review', 'Refactor', 'Test', 'Debug', 'Deploy', 'Document', 'Optimize'];
        $objects = ['user authentication', 'dashboard UI', 'API endpoints', 'database schema', 'payment system', 'notification service', 'report generator', 'mobile responsive layout'];
        $title = $this->faker->randomElement($verbs) . ' ' .
            $this->faker->randomElement($objects) . ' ' .
            $this->faker->randomElement(['for production', 'by Friday', 'with tests', 'using best practices', 'with documentation']);

        $title = substr($title, 0, 255);

        return [
            'title' => $title,
            'description' => $this->faker->paragraph,
            'created_at' => $this->faker->dateTime,
            'updated_at' => $this->faker->dateTime,
            'status_id' => rand(1,3),
        ];
    }
    public function configure()
    {
        return $this->afterCreating(function ($task) {
            $users = User::inRandomOrder()->take(rand(1, 3))->get();
            $task->employees()->attach($users);
        });
    }
}
