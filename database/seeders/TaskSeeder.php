<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TaskSeeder extends Seeder
{
    public $category = ['task', 'daily_test', 'mid_test', 'final_test'];
    public $taskName = ['Membuat Rumus Kalkulus', 'Membuat Puisi', 'Mengerjakan exercise 10', 'Membuat Rangkuman', 'Membuat contoh soal', 'Mengerjakan soal', 'Mencari jenis-jenis Bola', 'Membuat Gamabar Sejarah', 'Membuat Pesawat', 'Menghafal Rumus', 'Evaluasi Mandiri', 'Krisis eksistensial'];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //membuat 300 tugas
        $taskCount = 300;
        for ($i = 0; $i < $taskCount; $i++) {
            $this->insert();
        }
    }

    public function insert()
    {
        DB::table('tasks')->insert([
            'name' => $this->taskName[rand(0, 11)],
            'teacher_id' => rand(1, 50),
            'class_room_id' => rand(1, 48),
            'category' => $this->category[rand(0, 3)],
        ]);
    }
}
