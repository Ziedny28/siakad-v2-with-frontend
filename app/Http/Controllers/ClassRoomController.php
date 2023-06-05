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
     * Display a listing of the resource.
     */
    public function index()
    {
        $teacherCount = Teacher::all()->count();
        $studentCount = Student::all()->count();
        $students = Student::all();
        $classRooms = ClassRoom::with('teacher')->get();
        return view('admin.schedule.index', ['teacherCount' => $teacherCount, 'studentCount' => $studentCount, 'classRooms' => $classRooms, 'students' => $students]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClassRoomRequest $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(ClassRoom $classRoom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClassRoom $classRoom)
    {
        return view('admin.schedule.edit', compact('classRoom'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClassRoomRequest $request, ClassRoom $classRoom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClassRoom $classRoom)
    {
        //
    }
}
