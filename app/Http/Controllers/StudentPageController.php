<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\Score;
use App\Models\Student;
use App\Models\Task;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class StudentPageController extends Controller
{
    // show the student dashboard page
    public function studentTask()
    {
        $task = Task::with('teacher.subject')->where('class_room_id', Auth::user()->class_room_id)
            ->orderBy('teacher_id')->paginate(10);

        // topboxes
        $scoreAvg = round(Score::where('student_id', Auth::user()->id)->avg('score'), 1); //getting average score of this student
        $taskCount = Task::where('class_room_id', Auth::user()->class_room_id)->count();

        return view('student.task.index', ['tasks' => $task, 'taskCount' => $taskCount, 'scoreAvg' => $scoreAvg]);
    }

    // show the student score page
    public function studentScore()
    {
        $student_id = Auth::user()->id; //getting student id
        $score = Score::with('task.teacher.subject')->where('student_id', $student_id)->orderBy(function (Builder $q) {
            $q->select('teacher_id')->from('tasks')->whereColumn('task_id', 'tasks.id');
        })->paginate(10);
        // topboxes
        $scoreAvg = round(Score::where('student_id', $student_id)->avg('score'), 1); //getting average score of this student
        $taskCount = Task::where('class_room_id', Auth::user()->class_room_id)->count();

        return view('student.score.index', ['scores' => $score, 'taskCount' => $taskCount, 'scoreAvg' => $scoreAvg]);
    }

    // show the student schedule page
    public function studentSchedule()
    {
        $class_room = ClassRoom::findOrFail(Auth::user()->class_room_id);
        return view('student.schedule.index', ['class_room' => $class_room]);
    }

    // show the student profile page
    public function studentProfile()
    {
        return view('student.my-profile', ['student' => Auth::user()]);
    }

    // show the student change password page
    public function changePassword()
    {
        $student = Student::findOrFail(auth()->user()->id);
        return view('student.change-password', [
            'student' => $student,
        ]);
    }

    // save the changed password of the student
    public function saveChangePassword(Request $request)
    {
        $credentials = $request->validate($this->credentialRules);
        //if student's old pass is not same with the one that just inputted
        if (!Auth::guard('student')->attempt($credentials)) {
            Alert::error('Gagal', 'Password lama salah');
            return redirect('/student-change-password');
        }

        // if new pass and new pass confirm is not same
        if ($request->newPass != $request->newPassConfirm) {
            Alert::error('Gagal', 'Password tidak sama');
            return redirect('/student-change-password');
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
