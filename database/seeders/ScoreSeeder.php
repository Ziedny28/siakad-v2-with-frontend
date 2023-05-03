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
        for($i=0;$i<100;$i++){
            DB::table('scores')->insert([
                'student_id' => rand(1,10),
                'task_id' => rand(1,20),
                'score' => rand(50,100),
            ]);
        }
    }
}
