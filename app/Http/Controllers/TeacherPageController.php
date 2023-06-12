<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherPageController extends Controller
{
    function teacherProfile()
    {
        $teacher_id = Auth::user()->id;
        return view('teacher.my-profile', ['teacher' => Teacher::findOrFail($teacher_id)]);
    }
}
