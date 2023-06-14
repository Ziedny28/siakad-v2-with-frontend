<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Score;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\ClassRoom;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /*
    if success login as student, first will be redirected to student dashboard
    this function will get data of this student, score, tasks data of this student
    */
    public function student()
    {
        $student_id = Auth::user()->id; //getting student id
        $student = Student::with('class_room')->findOrFail($student_id); //getting data of this one student
        $tasks = Task::with('teacher.subject')->where('class_room_id', $student->class_room_id)->get(); //getting tasks data of this student
        $scores = Score::with('task.teacher.subject')->where('student_id', $student_id)->get(); //getting score data of this student

        return view('student.dashboard', [
            'tasks' => $tasks,
            'student' => $student,
            'scores' => $scores,
        ]);
    }

    /*
    if success login as teacher, first will be redirected to teacher dashboard

    */
    public function teacher()
    {

        $teacher_id = Auth::user()->id; //getting teacher id
        $teacher = Teacher::with(['subject'])->findOrFail($teacher_id); //getting data of this one teacher with subject
        $tasks = Task::with('class_room')->where('teacher_id', $teacher_id)->get(); //getting tasks data of this teacher

        /*
        get the class rooms that this teacher teach in teacher_class_room table
        */
        $class_rooms = $this->getClassRoom($teacher_id);

        //getting scores data of this teacher
        $scores = Score::with('task.teacher.subject')
            ->where(Task::select('teacher_id')->whereColumn('tasks.id', 'scores.task_id'), $teacher_id)
            ->orderBy(Task::select('class_room_id')->whereColumn('tasks.id', 'scores.task_id'))
            ->get();

        return view('teacher.dashboard', [
            'scores' => $scores,
            'teacher' => $teacher,
            'class_rooms' => $class_rooms,
            'tasks' => $tasks,
            'teacherCount' => Teacher::count(),
            'studentCount' => Student::count(),
        ]);
    }

    //getting ClassRoom data that this teacher teach
    public function getClassRoom($teacher_id)
    {
        $teacher_class_room = DB::table('teacher_class_room')->where('teacher_id', $teacher_id)->pluck('class_room_id'); // get the class room id that this teacher teach
        $class_rooms = ClassRoom::whereIn('id', $teacher_class_room)->get();
        return $class_rooms;
    }

    /*
    if success login as admin, first will be redirected to admin dashboard
    */
    public function admin()
    {
        $student = Student::with('class_room')->orderBy('class_room_id')->get(); //getting all students data with class room and order by class room
        $teacher = Teacher::with('subject')->get(); //getting all teachers data with subject
        $subjects = Subject::with('teachers')->get(); //getting all subjects data with teachers
        $class_rooms = ClassRoom::with(['teachers', 'teacher'])->get(); //getting all class rooms data with teachers

        return view('admin.dashboard', [
            'students' => $student,
            'teachers' => $teacher,
            'admin' => Auth::user(),
            'subjects' => $subjects,
            'class_rooms' => $class_rooms,
        ]);
    }
}
