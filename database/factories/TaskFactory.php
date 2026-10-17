<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Period;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Task>
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
            'category_id' => Category::inRandomOrder()->value('id') ?? Category::factory()->create()->id,
            'period_id'=> Period::inRandomOrder()->value('id') ?? Period::factory()->create()->id,
            'user_id' => User::inRandomOrder()->value('id') ?? User::factory()->create()->id,
            'name' => fake()->words(4,true),
            'level_of_urgency' => fake()->randomElement(
                ['critical', 'high', 'medium', 'low']
            ),
            'due_date' => fake()->datetime(),
            'is_completed' => fake()->boolean()
        ];
    }
}
