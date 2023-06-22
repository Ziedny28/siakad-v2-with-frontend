<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ScoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //making 2000 scores
        $scoreCount = 2000;
        $studentCount = 500;
        for ($i = 0; $i < $scoreCount; $i++) {
            DB::table('scores')->insert([
                'student_id' => rand(1, $studentCount),
                'task_id' => rand(1, 300),
                'score' => rand(0, 100),
            ]);
        }
    }
}
