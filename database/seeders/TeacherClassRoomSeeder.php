<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TeacherClassRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 0; $i < 100; $i++){
            $this->insert();
        }
    }

    public function insert(){
        DB::table('teacher_class_room')->insert([
            'teacher_id' => rand(1,10),
            'class_room_id' => rand(1,10),
        ]);
    }
}
