<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\ClassRoom;
use App\Models\Student;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class TaskController extends Controller
{
    // available categories
    private $categories = ['task', 'daily_test', 'mid_test', 'final_test'];
    /**
     * show the tasks that created by this teacher
     */
    public function index(Request $request)
    {
        $teacher_id = Auth::user()->id; //getting teacher id

        if ($request->input('search')) {
            $search = $request->input('search');
            $tasks = Task::search($search)->where('teacher_id', $teacher_id)->paginate(10);
        } else {
            $tasks = Task::with('class_room')->where('teacher_id', $teacher_id)->paginate(10); //getting tasks data of this teacher with class room
        }


        $taskCount = Task::where('teacher_id', $teacher_id)->count();
        $studentCount = Student::count();

        return view('teacher.task.index', [
            'tasks' => $tasks,
            'taskCount' => $taskCount,
            'studentCount' => $studentCount,
        ]);
    }

    /**
     * show page to create task
     */
    public function create()
    {
        $teacher_id = Auth::user()->id; //getting teacher id
        $class_rooms = $this->getClassRoom($teacher_id);
        return view('teacher.task.create', [
            'class_rooms' => $class_rooms,
            'categories' => $this->categories,
        ]);
    }

    /**
     * save task data
     */
    public function store(StoreTaskRequest $request)
    {
        Task::create($request->validated());
        Alert::success('Success', 'Berhasil Membuat Tugas');
        return redirect()->route('task.index');
    }

    /**
     * show page to edit task
     */
    public function edit(Task $task)
    {
        $teacher_id = Auth::user()->id; //getting teacher id
        $class_rooms = $this->getClassRoom($teacher_id);
        return view('teacher.task.edit', [
            'class_rooms' => $class_rooms,
            'categories' => $this->categories,
            'task' => $task,
            'teacher_id' => $teacher_id,
        ]);
    }

    /**
     * saving edited task
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $data = $request->validated();
        $task->fill($data);
        $task->save();
        Alert::success('Success', 'Berhasil Mengubah Tugas');
        return redirect()->route('task.index');
    }

    /**
     * \delete task
     */
    public function destroy(Task $task)
    {
        try {
            $task = Task::findOrFail($task->id);
            $task->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == "23000") {
                Alert::error('Error', 'Data Ini terpakai pada data lain');
                return back();
            }
        }

        Alert::success('Success', 'Berhasil Menghapus Tugas');
        return redirect()->route('task.index');
    }

    /**
     * get class room that this teacher teach
     */
    public function getClassRoom($teacher_id)
    {
        $teacher_class_room = DB::table('teacher_class_room')->where('teacher_id', $teacher_id)->pluck('class_room_id'); // get the class room id that this teacher teach
        $class_rooms = ClassRoom::whereIn('id', $teacher_class_room)->get();
        return $class_rooms;
    }
}
