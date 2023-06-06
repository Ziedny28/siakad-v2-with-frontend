<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\ClassRoom;
use Illuminate\Http\Request;

class AjaxRequestController extends Controller
{
    public function classRoom()
    {
        $data = ClassRoom::where('name', 'LIKE', '%' . request('q') . '%')->get();
        return response()->json($data);
    }

    public function task($id)
    {
        $data = Task::where('class_room_id', $id)->where('name', 'LIKE', '%' . request('q') . '%')->get();
        return response()->json($data);
    }
}
