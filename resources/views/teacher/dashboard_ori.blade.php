@extends('layouts.main')

@section('content')
    <h1>Dashboard</h1>
    <div class="row">
        <div class="col-11">
            <h4>Halo Guru, Selamat datang,
                {{-- mendapatkan nama user --}}
                {{ $teacher->name }}
            </h4>
        </div>
        <div class="col-1">

            <a href="/logout" class="btn btn-danger">logout</a>
        </div>
    </div>

    {{-- data guru start --}}
    <h5 class="mt-5">Data Guru</h5>
    <p>Nama:{{ $teacher->name }}</p>
    <p>Alamat:{{ $teacher->address }}</p>
    <p>TTL:{{ $teacher->pob }}</p>
    <p>Mapel:{{ $teacher->subject->name }}</p>
    {{-- data guru end --}}

    <a href="/task" class="btn btn-success">data tugas</a>
    <a href="/score" class="btn btn-success">data nilai</a>

    <div class="row">
        <div class="col-6">
            <h4>kelas</h4>
            @foreach ($class_rooms as $class_room)
                <li>{{ $class_room->name }}</li>
            @endforeach
        </div>
        <div class="col-6">
        </div>
    </div>

    {{-- task start --}}
    <h4>Tasks</h4>
    <ol>
    @foreach ($tasks as $task)
        <li>{{$task->name}},{{$task->class_room->name}}</li>
    @endforeach
</ol>
    {{-- task end --}}

    {{-- score start --}}
    <h4>ScoreS</h4>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Mata Pelajaran</th>
                <th>Tipe</th>
            </tr>
        </thead>
        <tbody>
            <?php $prevData = ''; ?>
            @foreach ($scores as $score)
                @if ($prevData != $score->task->class_room->name)
                    <tr>
                        <td>
                            <h4>{{ $score->task->class_room->name }}</h4>
                        </td>
                    </tr>
                @endif
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $score->student->name }}{{ $score->student->class_room_id }}</td>
                    <td>{{ $score->task->teacher->subject->name }}</td>
                    <td>{{ $score->task->category }}</td>
                </tr>
                <?php $prevData = $score->task->class_room->name; ?>
            @endforeach
        </tbody>
    </table>
    {{-- score end --}}
@endsection
