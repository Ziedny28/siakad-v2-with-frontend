<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = ['Fisika', 'Biologi', 'Kimia', 'Matematika Wajib', 'Matematika Peminatan', 'Fiqih', 'Quran Hadist', 'Akidah Akhlak', 'Bahasa Indonesia', 'Pendidikan Kewarganegaraan', 'Olagraha', 'Bahasa Arab', 'Bahasa prancis'];

        foreach ($subjects as $subject) :
            DB::table('subjects')->insert(['name' => $subject, 'description' => '']);
        endforeach;
    }
}
