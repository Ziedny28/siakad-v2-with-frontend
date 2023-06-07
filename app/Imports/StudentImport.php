<?php

namespace App\Imports;

use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Student([
            'name'     => $row['name'],
            'ni' => $row['ni'],
            'address' => $row['address'],
            'pob' => $row['pob'],
            'password' => Hash::make($row['password']),
            'email'    => $row['email'],
            'class_room_id' => DB::table('class_rooms')->where('name', $row['class_room'])->first()->id,
        ]);
    }
}
