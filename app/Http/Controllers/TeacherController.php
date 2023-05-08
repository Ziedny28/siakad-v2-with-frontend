<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.teacher.index', [
            'teachers' => Teacher::with('subject')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subjects = Subject::all();
        return view('admin.teacher.create', [
            'subjects' => $subjects,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTeacherRequest $request)
    {

        $teacher = $request->validated();
        $teacher['password'] = Hash::make($request->password);
        Teacher::create($teacher);
        return redirect()->route('teachers.index')->with('success', 'Teacher created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        $teacher = Teacher::with('subject')->findOrFail($teacher->id);
        return view('admin.teacher.edit', [
            'teacher' => $teacher,
            'subjects' => Subject::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTeacherRequest $request, Teacher $teacher)
    {
        $data = $request->validated();
        $teacher->fill($data);
        $teacher->save();
        return redirect()->route('teachers.index')->with('success', 'Teacher updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        //
    }
}
