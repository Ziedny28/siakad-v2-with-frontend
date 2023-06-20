<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use RealRashid\SweetAlert\Facades\Alert;

class SubjectController extends Controller
{
    /**
     * showing all subjects
     */
    public function index()
    {
        return view('admin.subject.index', [
            'teachers' => Teacher::with('subject')->get(),
            'subjects' => Subject::paginate(5),
            'students' => Student::all(),
        ]);
    }

    /**
     * showing page to create new subject
     */
    public function create()
    {
        return view('admin.subject.create');
    }

    /**
     * saving new subject
     */
    public function store(StoreSubjectRequest $request)
    {
        $subject = $request->validated();
        Subject::create($subject);
        Alert::success('Success', 'Berhasil Membuat Mata Pelajaran');
        return redirect()->route('subjects.index');
    }

    /**
     * showing page to edit subject
     */
    public function edit(Subject $subject)
    {
        return view('admin.subject.edit', compact('subject'));
    }

    /**
     * saving edited subject
     */
    public function update(UpdateSubjectRequest $request, Subject $subject)
    {
        $data = $request->validated();
        $subject->fill($data);
        $subject->save();
        Alert::success('Success', 'Berhasil Mengubah Mata Pelajaran');
        return redirect()->route('subjects.index')->with('success', 'Subject updated successfully');
    }

    /**
     * delete selected subject
     */
    public function destroy(Subject $subject)
    {
        try {
            DB::table('subjects')->where('id', $subject->id)->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == "23000") {
                Alert::error('Error', 'Data Ini terpakai pada data lain');
                return redirect()->route('subjects.index');
            }
        }


        Alert::success('Success', 'Berhasil Menghapus Mata Pelajaran');
        return redirect()->route('subjects.index');
    }
}
