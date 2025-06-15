<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample tasks for the test user
        $testUserId = 1; // Assuming test user has ID 1

        // Create various types of tasks
        Task::create([
            'user_id' => $testUserId,
            'title' => 'Complete Laravel Project',
            'type' => 'Work',
            'priority' => 'High',
            'due_date' => now()->addDays(7),
            'due_time' => '17:00:00',
            'description' => 'Finish the Todo App project with all features implemented',
            'status' => 'active',
        ]);

        Task::create([
            'user_id' => $testUserId,
            'title' => 'Prepare Presentation',
            'type' => 'Work',
            'priority' => 'High',
            'due_date' => now()->addDays(1),
            'due_time' => '09:00:00',
            'description' => 'Prepare slides and demo for project presentation',
            'status' => 'active',
        ]);

        Task::create([
            'user_id' => $testUserId,
            'title' => 'Buy Groceries',
            'type' => 'Personal',
            'priority' => 'Medium',
            'due_date' => now()->addDays(2),
            'description' => 'Buy weekly groceries from supermarket',
            'status' => 'active',
        ]);

        Task::create([
            'user_id' => $testUserId,
            'title' => 'Study Database Design',
            'type' => 'Other',
            'priority' => 'Medium',
            'due_date' => now()->addDays(5),
            'due_time' => '20:00:00',
            'description' => 'Review database normalization and relationships',
            'status' => 'active',
        ]);

        Task::create([
            'user_id' => $testUserId,
            'title' => 'Setup Development Environment',
            'type' => 'Work',
            'priority' => 'Low',
            'due_date' => now()->subDays(2),
            'description' => 'Install and configure Laravel development tools',
            'status' => 'done',
            'completed_at' => now()->subDays(2),
        ]);

        Task::create([
            'user_id' => $testUserId,
            'title' => 'Read Laravel Documentation',
            'type' => 'Other',
            'priority' => 'Medium',
            'due_date' => now()->subDays(1),
            'description' => 'Study Laravel 12 new features and best practices',
            'status' => 'done',
            'completed_at' => now()->subDays(1),
        ]);

        // Create additional random tasks using factory
        Task::factory(10)->create([
            'user_id' => $testUserId,
        ]);
    }
}
