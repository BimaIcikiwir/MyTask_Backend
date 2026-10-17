<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Period;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        Category::factory()->count(10)->create();

        Period::factory()->create([
            'name' => 'daily'
        ]);

        Period::factory()->create([
            'name' => 'weekly'
        ]);

        Period::factory()->create([
            'name' => 'monthly'
        ]);

        User::factory()->count(10)->create();

        Task::factory()->count(20)->create();
    }
}
