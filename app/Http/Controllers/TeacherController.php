<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\ClassRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Imports\TeacherImport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.teacher.index', [
            'teachers' => Teacher::with('subject')->paginate(10),
            'students' => Student::all(),
            'teacherCount' => Teacher::count(), //counting all teachers
            'studentCount' => Student::count(),
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
        // $teachers_class_rooms_access = DB::table('teacher_class_room')->where('teacher_id', $teacher->id)->get();

        // getting classroom data where there's the teacher isnt assigned to it, soo we can only input the classroom where this teacher isn't assigned to
        $excluded_class_rooms = DB::table('teacher_class_room')->where('teacher_id', $teacher->id)->pluck('class_room_id')->toArray();
        $class_rooms = ClassRoom::whereNotIn('id', $excluded_class_rooms)->get();

        $all_class_rooms = ClassRoom::all();

        // getting classroom data where there's the teacher is assigned to it
        $assigned_class_rooms = DB::table('teacher_class_room')->where('teacher_id', $teacher->id)->pluck('class_room_id')->toArray();

        return view('admin.teacher.edit', [
            'teacher' => $teacher,
            'class_rooms' => $class_rooms,
            'subjects' => Subject::all(),
            'assigned_class_rooms' => $assigned_class_rooms,
            'all_class_rooms' => $all_class_rooms,
            // 'teachers_class_rooms_access' => $teachers_class_rooms_access,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher)
    {
        // dd($request->all());
        $class_room = $request->validate([
            "inputs.*.class_room_id" => 'required'
        ]);

        // gantikan data lama dengan data baru
        DB::table('teacher_class_room')->where('teacher_id', $teacher->id)->delete();
        foreach ($class_room['inputs'] as $class_room_id) {
            DB::table('teacher_class_room')->insert([
                'class_room_id' => $class_room_id['class_room_id'],
                'teacher_id' => $teacher->id,
            ]);
        }

        $teacherRequest = $this->getTeacherData($request);
        $data = $teacherRequest;
        $teacher->fill($data);
        $teacher->save();
        return redirect()->route('teachers.index')->with('success', 'Teacher updated successfully');
    }

    public function getTeacherData(Request $teacherRequest)
    {
        $teacherRules = new UpdateTeacherRequest;
        $teacherRules = $teacherRules->rules();
        return $teacherRequest->validate($teacherRules);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        //
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    // importing
    public function import()
    {
        Excel::import(new TeacherImport, request()->file('file'));
        return back();
    }
}
