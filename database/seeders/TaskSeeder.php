<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TaskSeeder extends Seeder
{
    public $category =['task','daily_test','mid_test','final_test'];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //membuat 20 tugas
        for($i=0;$i<20;$i++){
            $this->insert();
        }
    }

    public function insert(){
        DB::table('tasks')->insert([
            'name' => '',
            'teacher_id' => rand(1,10),
            'class_room_id' => rand(1,10),
            'category' => $this->category[rand(0,3)],
        ]);
    }
}
