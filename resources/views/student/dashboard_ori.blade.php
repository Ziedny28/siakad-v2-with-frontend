@extends('layouts.main')

@section('content')
    <h1>Dashboard</h1>
    <div class="row">
        <div class="col-11">
            <h4>Selamat datang,
                {{-- mendapatkan nama user --}}
                {{ $student->name }}
            </h4>
        </div>
        <div class="col-1">

            <a href="/logout" class="btn btn-danger">logout</a>
        </div>
    </div>

    {{-- data siswa start --}}
    <h5 class="mt-5">Data Siswa</h5>
    <p>Nama:{{ $student->name }}</p>
    <p>Alamat:{{ $student->address }}</p>
    <p>TTL:{{ $student->pob }}</p>
    <p>Kelas:{{ $student->class_room->name }}</p>
    {{-- data siswa end --}}


    {{-- tasks --}}
    <h4>Tasks</h4>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Mata Pelajaran</th>
                <th>Guru</th>
                <th>Tipe</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$task->name}}</td>
                    <td>{{$task->teacher->subject->name}}</td>
                    <td>{{$task->teacher->name}}</td>
                    <td>{{$task->category}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- end task --}}

    {{-- scores start --}}
    <h4>Scores</h4>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Mata Pelajaran</th>
                <th>Guru</th>
                <th>Nilai</th>
                <th>Tipe</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($scores as $score)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $score->task->teacher->subject->name }}</td>
                    <td>{{ $score->task->teacher->name }}</td>
                    <td>{{ $score->score }}</td>
                    <td>{{ $score->task->category }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- scores end --}}
@endsection
