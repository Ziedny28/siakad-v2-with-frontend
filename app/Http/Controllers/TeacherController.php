<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\ClassRoom;
use Illuminate\Http\Request;
use App\Imports\TeacherImport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;

class TeacherController extends Controller
{
    /**
     * showing page to see all teachers
     */
    public function index()
    {
        return view('admin.teacher.index', [
            'teachers' => Teacher::with('subject')->paginate(5),
            'teacherCount' => Teacher::count(), //count all teachers
            'studentCount' => Student::count(), //count all students
        ]);
    }

    /**
     * show page to create new teacher
     */
    public function create()
    {
        return view('admin.teacher.create', [
            'subjects' => Subject::all(),
        ]);
    }

    /**
     * store new teacher to database
     */
    public function store(StoreTeacherRequest $request)
    {
        $teacher = $request->validated();
        $teacher['password'] = Hash::make($request->password); //hashing password
        Teacher::create($teacher);
        Alert::success('Success', 'Berhasil Membuat Guru');
        return redirect()->route('teachers.index');
    }

    /**
     * show page to edit teacher
     */
    public function edit(Teacher $teacher)
    {
        $teacher = Teacher::with('subject')->findOrFail($teacher->id);

        // getting classroom data where there's the teacher isnt assigned to it, so we can only input the classroom where this teacher isn't assigned to
        $excluded_class_rooms = DB::table('teacher_class_room')->where('teacher_id', $teacher->id)->pluck('class_room_id')->toArray();
        $class_rooms = ClassRoom::whereNotIn('id', $excluded_class_rooms)->get();

        // getting classroom data where there's the teacher is assigned to it
        $assigned_class_rooms = DB::table('teacher_class_room')->where('teacher_id', $teacher->id)->pluck('class_room_id')->toArray();

        return view('admin.teacher.edit', [
            'teacher' => $teacher,
            'class_rooms' => $class_rooms,
            'subjects' => Subject::all(),
            'assigned_class_rooms' => $assigned_class_rooms,
            'all_class_rooms' => ClassRoom::all(),
        ]);
    }

    /**
     * save updated teacher to database
     */
    public function update(Request $request, Teacher $teacher)
    {
        $class_room = $request->validate([
            "inputs.*.class_room_id" => 'required'
        ]);

        // change the teacher access by change teacher_class_room table data
        DB::table('teacher_class_room')->where('teacher_id', $teacher->id)->delete();

        // insert new teacher_access data to teacher_class_room table
        foreach ($class_room['inputs'] as $class_room_id) {
            DB::table('teacher_class_room')->insert([
                'class_room_id' => $class_room_id['class_room_id'],
                'teacher_id' => $teacher->id,
            ]);
        }

        // get teacher data from function
        $teacherRequest = $this->getTeacherData($request);
        $data = $teacherRequest;

        // check if there's a schedule file
        if ($request->file('schedule')) {
            $schedule = $request->file('schedule')->store('teacher/schedule');
            $data['schedule'] = $schedule;
        }

        //save updated teacher data
        $teacher->fill($data);
        $teacher->save();
        Alert::success('Success', 'Berhasil Mengubah Guru');
        return redirect()->route('teachers.index');
    }

    /**
     * get necessaries teacher data from request
     */
    public function getTeacherData(Request $teacherRequest)
    {
        $teacherRules = new UpdateTeacherRequest;
        $teacherRules = $teacherRules->rules();
        return $teacherRequest->validate($teacherRules);
    }

    /**
     * delete teacher data from database
     */
    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        Alert::success('Success', 'Berhasil Menghapus Guru');
        return redirect()->route('teachers.index');
    }

    /**
     * import teacher data from excel with laravel excel
     */


    public function import()
    {
        Excel::import(new TeacherImport, request()->file('file'));
        Alert::success('Success', 'Teacher imported successfully');
        return back();
    }

    /**
     * search teacher data from database
     */

    public function search(Request $request)
    {
        $query = $request->input('search');
        $teachers = Teacher::search($query)->paginate(10);

        return view('admin.teacher.index', [
            'teachers' => $teachers,
            'teacherCount' => Teacher::count(),
            'studentCount' => Student::count(),
        ]);
    }
}
