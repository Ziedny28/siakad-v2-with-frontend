<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\ClassRoom;
use App\Imports\StudentImport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * showing page to see all students with pagination each 5 students
     */
    public function index()
    {
        return view('admin.student.index', [
            'students' => Student::with('class_room')->orderBy('name')->paginate(5),
            'teacherCount' => Teacher::count(), //counting all teachers
            'studentCount' => Student::count(),
            'major' => 'All',
        ]);
    }

    /**
     * showing page to create new student
     */
    public function create()
    {
        return view('admin.student.create', [
            'class_rooms' => ClassRoom::all()->sortBy('name'),
        ]);
    }

    /**
     * save student data
     */
    public function store(StoreStudentRequest $request)
    {
        $student = $request->validated();
        $student['password'] = Hash::make($request->password);
        Student::create($student);
        Alert::success('Success', 'Student created successfully');
        return redirect()->route('students.index');
    }


    /**
     * Show the form for editing student
     */
    public function edit(Student $student)
    {
        $student = Student::with('class_room')->findOrFail($student->id);
        return view('admin.student.edit', [
            'student' => $student,
            'class_rooms' => ClassRoom::all()->sortBy('name'),
        ]);
    }

    /**
     * Update the student in database
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        $data = $request->validated();
        $student->fill($data);
        $student->save();
        Alert::success('Success', 'Student updated successfully');
        return redirect()->route('students.index');
    }

    /**
     * Remove student from database
     */
    public function destroy(Student $student)
    {
        try {
            $student = Student::findOrFail($student->id);
            $student->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == "23000") {
                Alert::error('Error', 'Data Ini terpakai pada data lain');
                return back();
            }
        }

        Alert::success('Success', 'Student deleted successfully');
        return redirect()->route('students.index');
    }

    /**
     * menampilkan halaman untuk melihat siswa berdasarkan jurusan
     */
    public function studentByMajor($major)
    {
        $class_rooms = ClassRoom::where('name', 'like', '%' . $major . '%')->pluck('id');
        $students = Student::whereIn('class_room_id', $class_rooms)->with('class_room')->paginate(5);
        return view('admin.student.index', [
            'students' => $students,
            'teachers' => Teacher::all(),
            'teacherCount' => Teacher::count(), //counting all teachers
            'studentCount' => Student::count(),
            'major' => $major,
        ]);
    }

    function import()
    {
        Excel::import(new StudentImport, request()->file('file'));
        Alert()->success('Success', 'Student imported successfully');
        return back();
    }

    function search(Request $request)
    {
        $query = $request->input('query');
        $students = Student::search($query)->paginate(10);
        return view('admin.student.index', [
            'students' => $students,
            'major' => $request->major,
            'teacherCount' => Teacher::count(), //counting all teachers
            'studentCount' => Student::count(),
        ]);
    }
}
