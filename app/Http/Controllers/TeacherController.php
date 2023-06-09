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
     * menampilkan halaman untuk melihat semua guru
     */
    public function index()
    {
        return view('admin.teacher.index', [
            'teachers' => Teacher::with('subject')->paginate(5),
            'teacherCount' => Teacher::count(), //menghitung semua guru
            'studentCount' => Student::count(),
        ]);
    }

    /**
     * menampilkan halmaan untuk membuat guru baru
     */
    public function create()
    {
        return view('admin.teacher.create', [
            'subjects' => Subject::all(),
        ]);
    }

    /**
     * menyimpan guru baru ke database
     */
    public function store(StoreTeacherRequest $request)
    {
        $teacher = $request->validated();
        $teacher['password'] = Hash::make($request->password); //melakukan hash pada password
        Teacher::create($teacher);
        Alert::success('Success', 'Berhasil Membuat Guru');
        return redirect()->route('teachers.index');
    }

    /**
     * menampilkan halaman edit guru
     */
    public function edit(Teacher $teacher)
    {
        $teacher = Teacher::with('subject')->findOrFail($teacher->id);

        // getting classroom data where there's the teacher isnt assigned to it, soo we can only input the classroom where this teacher isn't assigned to
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
     * menyimpan data hasil edit
     */
    public function update(Request $request, Teacher $teacher)
    {
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
        Alert::success('Success', 'Berhasil Mengubah Guru');
        return redirect()->route('teachers.index');
    }

    public function getTeacherData(Request $teacherRequest)
    {
        $teacherRules = new UpdateTeacherRequest;
        $teacherRules = $teacherRules->rules();
        return $teacherRequest->validate($teacherRules);
    }

    /**
     * menghapus data guru
     */
    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        Alert::success('Success', 'Berhasil Menghapus Guru');
        return redirect()->route('teachers.index');
    }

    /**
     * proses import data guru dengan menggunakan laravel excel
     */


    public function import()
    {
        Excel::import(new TeacherImport, request()->file('file'));
        Alert::success('Success', 'Teacher imported successfully');
        return back();
    }

    /**
     * menampilkan halaman hasil pencarian
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
