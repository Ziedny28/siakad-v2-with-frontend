<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class TeacherPageController extends Controller
{
    //show teacher profile page
    function teacherProfile()
    {
        $teacher_id = Auth::user()->id;
        return view('teacher.my-profile', ['teacher' => Teacher::findOrFail($teacher_id)]);
    }

    //show change password page
    function changePassword()
    {
        $teacher_id = Auth::user()->id;
        return view('teacher.change-password', ['teacher' => Teacher::findOrFail($teacher_id)]);
    }

    //save changed password
    function saveChangePassword(Request $request)
    {
        $credentials = $request->validate($this->credentialRules);
        //if teacher's old pass is not same with the one that just inputted
        if (!Auth::guard('teacher')->attempt($credentials)) {
            Alert::error('Gagal', 'Password lama salah');
            return redirect('/teacher-change-password');
        }

        // if new pass and new pass confirm is not same
        if ($request->newPass != $request->newPassConfirm) {
            Alert::error('Gagal', 'Password tidak sama');
            return redirect('/teacher-change-password');
        }

        $student = Teacher::findOrFail(auth()->user()->id);
        $student->password = Hash::make($request->newPass);
        $student->save();

        Alert::success('Berhasil', 'Password berhasil diubah');
        return redirect('/dashboard-teacher');
    }

    private $credentialRules = [
        'ni' => ['required', 'string', 'max:255'],
        'password' => ['required', 'string', 'max:255'],
    ];

    //show teacher schedule page
    function teacherSchedule()
    {
        $teacher = Teacher::findOrFail(Auth::user()->id);
        return view('teacher.schedule.index', ['teacher' => $teacher]);
    }
}
