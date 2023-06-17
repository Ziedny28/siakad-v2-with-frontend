<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\ClassRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StoreClassRoomRequest;
use App\Http\Requests\UpdateClassRoomRequest;

class ClassRoomController extends Controller
{
    /**
     * showing page to see all class rooms
     */
    public function index()
    {
        $classRooms = ClassRoom::with('teacher')->paginate(10);
        return view('admin.schedule.index', ['teacherCount' => Teacher::count(), 'studentCount' => Student::count(), 'classRooms' => $classRooms, 'students' => Student::all()]);
    }

    /**
     * Show the form for editing schedule.
     */
    public function scheduleEdit(ClassRoom $classRoom)
    {
        return view('admin.schedule.edit', compact('classRoom'));
    }

    /**
     * Update the schedule in storage.
     */
    public function scheduleUpload(Request $request)
    {
        $validated = $request->validate(['image' => 'file|', 'class_room_id' => 'required']);

        if ($request->file('image')) {
            if ($request->oldScheduleImage) {
                Storage::delete($request->oldScheduleImage);
            }
            $validated['schedule'] = $request->file('image')->store('schedules');
            DB::table('class_rooms')->where('id', $validated['class_room_id'])->update(['schedule' => $validated['schedule']]);

            Alert::success('Berhasil', 'Jadwal berhasil diupload');
            return redirect()->route('schedule.index');
        }
        Alert::error('Gagal', 'Jadwal gagal diupload');
        return redirect()->route('schedule.index');
    }
}
