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
        //making 1000 scores
        $scoreCount = 1000;
        for ($i = 0; $i < $scoreCount; $i++) {
            DB::table('scores')->insert([
                'student_id' => rand(1, 1000),
                'task_id' => rand(1, 300),
                'score' => rand(0, 100),
            ]);
        }
    }
}
