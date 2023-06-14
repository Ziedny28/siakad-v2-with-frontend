<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Score;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\ClassRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreScoreRequest;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\UpdateScoreRequest;

class ScoreController extends Controller
{
    /*
      show the scores that created by this teacher
     */
    public function index()
    {
        $teacher_id = Auth::user()->id; //get the teacher id

        /*
        get the scores with the task and the teacher and the subject of this teacher adn order by class room
        using subquerry to get teacher id from task table and compare it with the teacher id of this teacher
        order by class room id from task table
        */
        $scores = Score::with('task.teacher.subject')
            ->where(Task::select('teacher_id')->whereColumn('tasks.id', 'scores.task_id'), $teacher_id)
            ->orderBy(Task::select('class_room_id')->whereColumn('tasks.id', 'scores.task_id'))
            ->paginate(10);
        /*
        get the class rooms that this teacher teach
        panggil relasi class_rooms pada model Teacher untuk mendapatkan class room yang diajar oleh teacher ini
        */
        $class_rooms = Teacher::findOrFail($teacher_id);
        $class_rooms = $class_rooms->class_rooms;

        $taskCount = Task::where('teacher_id', $teacher_id)->count();

        return view('teacher.score.index', ['scores' => $scores, 'class_rooms' => $class_rooms, 'taskCount' => $taskCount, 'studentCount' => Student::count()]);
    }

    /**
     * show create score page
     */
    public function create()
    {
        $teacher_id = Auth::user()->id; // get the teacher id
        $tasks = Task::with('class_room')->where('teacher_id', $teacher_id)->get(); // get the tasks of this teacher with class room

        //classroom accessable by this teacher
        $class_rooms = $this->getClassRooms();

        return view('teacher.score.create', ['tasks' => $tasks, 'class_rooms' => $class_rooms]);
    }

    /**
     *  insert score to database
     */
    public function store(Request $request)
    {
        // doing validation
        $validated = $request->validate([
            'inputs.*.score' => 'required|numeric|min:0|max:100',
            'class_room_id' => 'required|exists:class_rooms,id',
            'task_id' => 'required',
        ]);

        //get all students in the selected class room
        $students = Student::where('class_room_id', $validated['class_room_id'])->get();

        //insert score for all students in the selected class room
        $i = 0;
        foreach ($students as $student) {
            $score = new Score();
            $score->student_id = $student->id;
            $score->task_id = $validated['task_id'];
            $score->score = $validated['inputs'][$i]['score'];
            $score->save();
            $i++;
        }

        //if success then redirect to score page
        Alert::success('Success', 'Score updated successfully');
        return redirect()->route('score.index');
    }

    /**
     * show page to edit score
     */
    public function edit(Score $score)
    {
        $students = Student::where('class_room_id', $score->task->class_room_id)->get();
        return view('teacher.score.edit', ['score' => $score, 'students' => $students]);
    }

    /**
     * show page for updating score
     */
    public function update(UpdateScoreRequest $request, Score $score)
    {
        $data = $request->validated();
        $score->fill($data);
        $score->save();
        Alert::success('Success', 'Score created successfully');
        return redirect()->route('score.index');
    }

    /**
     * show page to see score by class room
     */
    public function classRoomScore($classRoomId)
    {
        $teacher_id = Auth::user()->id;

        /*
        get the class rooms that this teacher teach
        panggil relasi class_rooms pada model Teacher untuk mendapatkan class room yang diajar oleh teacher ini
        */
        $class_rooms = Teacher::findOrFail($teacher_id);
        $class_rooms = $class_rooms->class_rooms;

        // get the scores with the task and the teacher and the subject of this teacher adn order by class room
        $scores = Score::where(Student::select('class_room_id')->whereColumn('students.id', 'scores.student_id'), $classRoomId)
            ->with('task.teacher.subject')
            ->orderBy(Task::select('class_room_id')->whereColumn('tasks.id', 'scores.task_id'))
            ->where(Task::select('teacher_id')->whereColumn('tasks.id', 'scores.task_id'), $teacher_id)
            ->paginate(10);

        return view('teacher.score.index', ['class_rooms' => $class_rooms, 'scores' => $scores]);
    }

    // functions for ajax requests
    public function getClassRooms()
    {
        //mendapatkan kelas apa saja yang diajar oleh guru ini
        $teacher_id = auth()->user()->id;
        $teacher_class_room = DB::table('teacher_class_room')->where('teacher_id',  $teacher_id)->pluck('class_room_id');
        $class_rooms = ClassRoom::whereIn('id', $teacher_class_room)->get();
        return $class_rooms;
    }

    public function getTasks(Request $request)
    {
        //mendapatkan tugas apa saja yang terdapat pada kelas yang diajar oleh guru ini dan milik guru ini
        $teacher_id = auth()->user()->id;
        $tasks = DB::table('tasks')
            ->where('teacher_id', $teacher_id)
            ->where('class_room_id', $request->class_room_id)
            ->get();

        if (count($tasks) > 0) {
            return response()->json($tasks);
        }
    }

    public function getStudents(Request $request)
    {
        //mendapatkan siswa apa saja yang terdapat pada kelas yang diminta oleh request
        $students = Student::where('class_room_id', $request->class_room_id)->get();
        if (count($students) > 0) {
            return response()->json($students);
        }
    }

    function search(Request $request)
    {
    }
}
