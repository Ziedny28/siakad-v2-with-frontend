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
        $accessCount = 200;
        for ($i = 0; $i < $accessCount; $i++) {
            $this->insert();
        }
    }

    public function insert()
    {
        $teacherCount = 30;
        DB::table('teacher_class_room')->insert([
            'teacher_id' => rand(1, $teacherCount),
            'class_room_id' => rand(1, 48),
        ]);
    }
}
