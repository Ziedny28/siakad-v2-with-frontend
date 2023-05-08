<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\ClassRoom;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teacher_id = Auth::user()->id; //getting teacher id
        $tasks = Task::with('class_room')->where('teacher_id', $teacher_id)->get(); //getting tasks data of this teacher with class room
        return view('teacher.task.index', ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teacher_id = Auth::user()->id; //getting teacher id
        $class_rooms = ClassRoom::with('teachers')->where('teacher_id', $teacher_id)->get(); //getting class rooms data of this teacher with teachers
        $categories = ['task','daily_test','mid_test','final_test'];

        return view('teacher.task.create', [
            'class_rooms' =>  $class_rooms,
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        Task::create($request->validated());
        return redirect()->route('task.index')->with('success', 'Task created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $teacher_id = Auth::user()->id; //getting teacher id
        $class_rooms = ClassRoom::with('teachers')->where('teacher_id', $teacher_id)->get(); //getting class rooms data of this teacher with teachers
        $categories = ['task','dialy_test','mid_test','final_test'];

        return view('teacher.task.edit', [
            'class_rooms' =>  $class_rooms,
            'categories' => $categories,
            'task' => $task,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $data = $request->validated();
        $task->fill($data);
        $task->save();
        return redirect()->route('task.index')->with('success', 'Task updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
    }
}
