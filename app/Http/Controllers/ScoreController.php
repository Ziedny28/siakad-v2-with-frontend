<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Score;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\ClassRoom;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreScoreRequest;
use App\Http\Requests\UpdateScoreRequest;

class ScoreController extends Controller
{
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
            ->get();


        /*
        get the class rooms that this teacher teach
        panggil relasi class_rooms pada model Teacher untuk mendapatkan class room yang diajar oleh teacher ini
        */
        $class_rooms = Teacher::findOrFail($teacher_id);
        $class_rooms = $class_rooms->class_rooms;


        return view('teacher.score.index', ['scores' => $scores, 'class_rooms' => $class_rooms]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teacher_id = Auth::user()->id;// get the teacher id
        $tasks = Task::with('class_room')->where('teacher_id', $teacher_id)->get();// get the tasks of this teacher with class room

        return view('teacher.score.create', ['tasks' => $tasks]);
    }

    // create the one score
    public function createOne($id)
    {
        $task = Task::with('class_room')->find($id); // get the task with class room
        $students = Student::where('class_room_id', $task->class_room_id)->get(); // get the students of this class room

        return view('teacher.score.create-one', [
            'task' => $task,
            'students' => $students,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreScoreRequest $request)
    {
        Score::create($request->validated());
        return redirect()->route('score.index')->with('success', 'Task created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Score $score)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Score $score)
    {
        $students = Student::where('class_room_id', $score->task->class_room_id)->get();
        return view('teacher.score.edit', ['score' => $score, 'students' => $students]);
    }

    // change to choosetask
    public function chooseEdit()
    {
        $teacher_id = Auth::user()->id;
        $tasks = Task::where('teacher_id', $teacher_id)->with('class_room')->get();
        return view('teacher.score.choose-edit', ['tasks' => $tasks]);
    }

    // change to choosescore
    public function editOne($id)
    {
        $task = Task::with('class_room')->find($id);

        $scores = Score::where('task_id', $task->id)->with('student')->get();
        return view('teacher.score.edit-one', [
            'task' => $task,
            'scores' => $scores,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateScoreRequest $request, Score $score)
    {
        $data = $request->validated();
        $score->fill($data);
        $score->save();
        return redirect()->route('score.index')->with('success', 'Score updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Score $score)
    {
        //
    }

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
}
