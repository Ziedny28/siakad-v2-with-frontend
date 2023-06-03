<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TaskSeeder extends Seeder
{
    public $category =['Tugas','Quis','UTS','UAS'];
    public $taskName = ['Membuat Rumus Kalkulus','Membuat Puisi','Mengerjakan exercise 10','Membuat Rangkuman','Membuat contoh soal','Mengerjakan soal','Mencari jenis-jenis Bola','Membuat Gamabar Anjing','Membuat Pesawat','Menghafal Alkitab','Evaluasi Mandiri'];
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
            'name' => $this->taskName[rand(0,10)],
            'teacher_id' => rand(1,10),
            'class_room_id' => rand(1,10),
            'category' => $this->category[rand(0,3)],
        ]);
    }
}
