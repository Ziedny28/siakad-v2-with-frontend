<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Score;
use App\Models\Student;
use App\Models\ClassRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Query\Builder;
use RealRashid\SweetAlert\Facades\Alert;

class StudentPageController extends Controller
{
    // menampilkan halaman tugas murid ini
    function studentTask()
    {
        $task = Task::with('teacher.subject')->where('class_room_id', Auth::user()->class_room_id)
            ->orderBy('teacher_id')->paginate(10);

        // topboxes
        $scoreAvg = Score::where('student_id', Auth::user()->id)->avg('score'); //getting average score of this student
        $taskCount = Task::where('class_room_id', Auth::user()->class_room_id)->count();

        return view('student.task.index', ['tasks' => $task, 'taskCount' => $taskCount, 'scoreAvg' => $scoreAvg]);
    }


    // menampilkan halaman nilai murid ini
    function studentScore()
    {
        $student_id = Auth::user()->id; //getting student id
        $score = Score::with('task.teacher.subject')->where('student_id', $student_id)->orderBy(function (Builder $q) {
            $q->select('teacher_id')->from('tasks')->whereColumn('task_id', 'tasks.id');
        })->paginate(10);
        // topboxes
        $scoreAvg = Score::where('student_id', $student_id)->avg('score'); //getting average score of this student
        $taskCount = Task::where('class_room_id', Auth::user()->class_room_id)->count();

        return view('student.score.index', ['scores' => $score, 'taskCount' => $taskCount, 'scoreAvg' => $scoreAvg]);
    }

    function studentSchedule()
    {
        $class_room = ClassRoom::findOrFail(Auth::user()->class_room_id);
        return view('student.schedule.index', ['class_room' => $class_room]);
    }

    function studentProfile()
    {
        return view('student.my-profile', ['student' => Auth::user()]);
    }


    function changePassword()
    {
        $student = Student::findOrFail(auth()->user()->id);
        return view('student.change-password', [
            'student' => $student,
        ]);
    }

    function saveChangePassword(Request $request)
    {
        $credentials = $request->validate($this->credentialRules);
        //if student's old pass is not same with the one that just inputted
        if (!Auth::guard('student')->attempt($credentials)) {
            Alert::error('Gagal', 'Password lama salah');
            return redirect('/change-password');
        }

        // if new pass and new pass confirm is not same
        if ($request->newPass != $request->newPassConfirm) {
            Alert::error('Gagal', 'Password tidak sama');
            return redirect('/change-password');
        }

        $student = Student::findOrFail(auth()->user()->id);
        $student->password = Hash::make($request->newPass);
        $student->save();

        Alert::success('Berhasil', 'Password berhasil diubah');
        return redirect('/dashboard-student');
    }

    private $credentialRules = [
        'ni' => ['required', 'string', 'max:255'],
        'password' => ['required', 'string', 'max:255'],
    ];
}
