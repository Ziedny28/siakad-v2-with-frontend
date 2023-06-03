<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password')
        ]);

        \App\Models\Admin::factory(10)->create();

        $this->call([SubjectSeeder::class,]);
        \App\Models\Teacher::factory(20)->create();
        $this->call([ClassroomSeeder::class,]);
        \App\Models\Student::factory(90)->create();
        $this->call([StudyActivitySeeder::class,]);
        $this->call([TeacherClassRoomSeeder::class,]);
        $this->call([TaskSeeder::class,]);
        $this->call([ScoreSeeder::class,]);

    }
}
