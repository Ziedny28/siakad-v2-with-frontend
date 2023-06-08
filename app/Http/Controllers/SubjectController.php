<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;

class SubjectController extends Controller
{
    /**
     * menampilkan semua mata pelajaran
     */
    public function index()
    {
        return view('admin.subject.index', [
            'teachers' => Teacher::with('subject')->get(),
            'subjects' => Subject::paginate(10),
            'students' => Student::all(),
        ]);
    }

    /**
     * menampilkan halaman membuat mata pelajaran baru
     */
    public function create()
    {
        return view('admin.subject.create');
    }

    /**
     * menyimpan mata pelajaran yang baru dibuat
     */
    public function store(StoreSubjectRequest $request)
    {
        $subject = $request->validated();
        Subject::create($subject);
        return redirect()->route('subjects.index')->with('success', 'Subject created successfully');
    }

    /**
     * menampilkan halaman untuk melakukan edit mata pelajaran
     */
    public function edit(Subject $subject)
    {
        return view('admin.subject.edit', compact('subject'));
    }

    /**
     * menyimpan hasil edit
     */
    public function update(UpdateSubjectRequest $request, Subject $subject)
    {
        $data = $request->validated();
        $subject->fill($data);
        $subject->save();
        return redirect()->route('subjects.index')->with('success', 'Subject updated successfully');
    }

    /**
     * menghapus mata pelajaran yang dipilih
     */
    public function destroy(Subject $subject)
    {
        DB::table('subjects')->where('id', $subject->id)->delete();
        return redirect()->route('subjects.index')->with('success', 'Subject removed successfully');
    }
}
