<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StudyActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i=0;$i<50;$i++){
            $this->insert();
        }
    }

    public function insert(){
        DB::table('study_activities')->insert([
            'teacher_id' => rand(1,10),
            'class_room_id' => rand(1,48),
        ]);
    }
}
