<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Http\Requests\StoreClassRoomRequest;
use App\Http\Requests\UpdateClassRoomRequest;
use App\Models\Student;
use App\Models\Teacher;

class ClassRoomController extends Controller
{
    /**
     * menampilkan seluruh kelas
     */
    public function index()
    {
        $teacherCount = Teacher::all()->count(); //mendapatkan jumlah data teacher
        $studentCount = Student::all()->count(); //mendapatkan jumlah data student
        $students = Student::all();
        $classRooms = ClassRoom::with('teacher')->get();
        return view('admin.schedule.index', ['teacherCount' => $teacherCount, 'studentCount' => $studentCount, 'classRooms' => $classRooms, 'students' => $students]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClassRoom $classRoom)
    {
        return view('admin.schedule.edit', compact('classRoom'));
    }
}
