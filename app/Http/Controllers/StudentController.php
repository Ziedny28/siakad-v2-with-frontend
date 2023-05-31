<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\ClassRoom;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Teacher;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.student.index', [
            'students' => Student::all(),
            'teachers'=> Teacher::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.student.create', [
            'class_rooms' => ClassRoom::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request)
    {
        $student = $request->validated();
        $student['password'] = Hash::make($request->password);
        Student::create($student);
        return redirect()->route('students.index')->with('success', 'Student created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $student = Student::with('class_room')->findOrFail($student->id);
        return view('admin.student.edit', [
            'student' => $student,
            'class_rooms' => ClassRoom::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        $data = $request->validated();
        $student->fill($data);
        $student->save();
        return redirect()->route('students.index')->with('success', 'Student updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $task = Student::findOrFail($student->id);
        $task->delete();
        return redirect()->route('student.index');
    }

    public function studentByMajor($major){
        $class_rooms = ClassRoom::where('name', 'like' , '%'.$major.'%')->pluck('id');
        $students = Student::whereIn('class_room_id',$class_rooms)->with('class_room')->paginate(20);
        return view('admin.student.index', [
            'students' => $students,
            'teachers'=> Teacher::all(),
        ]);
    }

}
