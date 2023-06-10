<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\ClassRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreClassRoomRequest;
use App\Http\Requests\UpdateClassRoomRequest;
use RealRashid\SweetAlert\Facades\Alert;

class ClassRoomController extends Controller
{
    /**
     * menampilkan seluruh kelas
     */
    public function index()
    {
        $classRooms = ClassRoom::with('teacher')->get();
        return view('admin.schedule.index', ['teacherCount' => Teacher::count(), 'studentCount' => Student::count(), 'classRooms' => $classRooms, 'students' => Student::all()]);
    }

    function edit()
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function scheduleEdit(ClassRoom $classRoom)
    {
        return view('admin.schedule.edit', compact('classRoom'));
    }

    public function scheduleUpload(Request $request)
    {
        $validated = $request->validate(['image' => 'file', 'class_room_id' => 'required']);

        if ($request->file('image')) {
            $validated['schedule'] = $request->file('image')->store('schedules');
            DB::table('class_rooms')->where('id', $validated['class_room_id'])->update(['schedule' => $validated['schedule']]);

            Alert::success('Berhasil', 'Jadwal berhasil diupload');
            return redirect()->route('schedule.index');
        }
        Alert::error('Gagal', 'Jadwal gagal diupload');
        return redirect()->route('schedule.index');
    }
}
