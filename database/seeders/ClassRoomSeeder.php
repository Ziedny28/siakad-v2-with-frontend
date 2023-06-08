<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassRoomSeeder extends Seeder
{
    public $majors = ['MIPA', 'IPS', 'Bahasa', 'Agama'];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 10; $i <= 12; $i++) {
            for ($j = 1; $j <= 4; $j++) {
                $this->insert($i, $j);
            }
        }
    }

    public function insert($i, $j)
    {

        for ($k = 0; $k < 4; $k++) {
            DB::table('class_rooms')->insert([
                'name' => $i . " " . $this->majors[$k] . " " . $j,
                'grade' => "$i",
                'schedule' => '',
                'teacher_id' => rand(1, 50)
            ]);
        }
    }
}
