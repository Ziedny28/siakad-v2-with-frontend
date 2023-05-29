<?php

namespace App\Http\Controllers;

use App\Models\Score;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\ClassRoom;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
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
    public function teacher()
    {

        $teacher_id = Auth::user()->id; //getting teacher id
        $teacher = Teacher::with(['subject'])->findOrFail($teacher_id); //getting data of this one teacher with subject
        $tasks = Task::with('class_room')->where('teacher_id', $teacher_id)->get(); //getting tasks data of this teacher
        $teacherCount = Teacher::count(); //counting all teachers
        $studentCount = Student::count(); //counting all students

        /*
        get the class rooms that this teacher teach
        panggil relasi class_rooms pada model Teacher untuk mendapatkan class room yang diajar oleh teacher ini
        */
        $class_rooms = Teacher::findOrFail($teacher_id);
        $class_rooms = $class_rooms->class_rooms;

        //getting scores data of this teacher
        $scores = Score::with('task.teacher.subject')
        ->where(Task::select('teacher_id')->whereColumn('tasks.id', 'scores.task_id'),$teacher_id)
        ->orderBy(Task::select('class_room_id')->whereColumn('tasks.id', 'scores.task_id'))
        ->get();

        return view('teacher.dashboard', [
            'scores' => $scores,
            'teacher' => $teacher,
            'class_rooms' => $class_rooms,
            'tasks' => $tasks,
            'teacherCount' => $teacherCount,
            'studentCount' => $studentCount,
        ]);
    }
    public function admin()
    {
        $admin = Auth::user(); //getting this admin data
        $student = Student::with('class_room')->orderBy('class_room_id')->get(); //getting all students data with class room and order by class room
        $teacher = Teacher::with('subject')->get(); //getting all teachers data with subject
        $subjects = Subject::with('teachers')->get(); //getting all subjects data with teachers
        $class_rooms = ClassRoom::with(['teachers','teacher'])->get(); //getting all class rooms data with teachers

        return view('admin.dashboard',[
            'students' => $student,
            'teachers' => $teacher,
            'admin' => $admin,
            'subjects' => $subjects,
            'class_rooms' => $class_rooms,
        ]);
    }
}
