<?php

namespace App\Imports;

use App\Models\Subject;
use App\Models\Teacher;

use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class TeacherImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Teacher([
            'name'     => $row['name'],
            'ni' => $row['ni'],
            'address' => $row['address'],
            'pob' => $row['pob'],
            'password' => Hash::make($row['password']),
            'email'    => $row['email'],
            'subject_id' => Subject::where('name', $row['subject'])->first()->id,
        ]);
    }
}
