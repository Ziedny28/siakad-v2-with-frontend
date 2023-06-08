<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\ClassRoom;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use RealRashid\SweetAlert\Facades\Alert;

class TaskController extends Controller
{
    /**
     * menampilkan halaman tugas
     */
    public function index()
    {
        $teacher_id = Auth::user()->id; //getting teacher id
        $tasks = Task::with('class_room')->where('teacher_id', $teacher_id)->paginate(10); //getting tasks data of this teacher with class room

        return view('teacher.task.index', ['tasks' => $tasks,]);
    }

    /**
     * menampilkan halaman untuk membuat tugas
     */
    public function create()
    {
        $teacher_id = Auth::user()->id; //getting teacher id

        $teacher_class_room = DB::table('teacher_class_room')->where('teacher_id', $teacher_id)->pluck('class_room_id'); // get the class room id that this teacher teach
        $class_rooms = ClassRoom::whereIn('id', $teacher_class_room)->get();

        $categories = ['task', 'daily_test', 'mid_test', 'final_test'];

        return view('teacher.task.create', [
            'class_rooms' =>  $class_rooms,
            'categories' => $categories,
        ]);
    }

    /**
     * menyimpan data tugas
     */
    public function store(StoreTaskRequest $request)
    {
        Task::create($request->validated());
        //buat nilai siswa dengan nilai 0 pada tugas ini di kelas ini

        Alert::success('Success', 'Berhasil Membuat Tugas');
        return redirect()->route('task.index');
    }

    /**
     * menampilkan halaman edit tugas
     */
    public function edit(Task $task)
    {
        $teacher_id = Auth::user()->id; //getting teacher id
        $class_rooms = ClassRoom::with('teachers')->where('teacher_id', $teacher_id)->get(); //getting class rooms data of this teacher with teachers
        $categories = ['task', 'dialy_test', 'mid_test', 'final_test'];

        return view('teacher.task.edit', [
            'class_rooms' =>  $class_rooms,
            'categories' => $categories,
            'task' => $task,
        ]);
    }

    /**
     * menyimpan hasil edit
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $data = $request->validated();
        $task->fill($data);
        $task->save();
        return redirect()->route('task.index')->with('success', 'Task updated successfully');
    }

    /**
     * menghapus tugas
     */
    public function destroy(Task $task)
    {
        $task = Task::findOrFail($task->id);
        $task->delete();
        return redirect()->route('task.index');
    }
}
