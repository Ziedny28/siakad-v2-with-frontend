@extends('layouts.main')

@section('content')
    {{-- score start --}}
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <h4>ScoreS</h4>
    <a href="/score/create">create new nilai</a>
    <a href="/score-choose-edit">edit nilai</a>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Mata Pelajaran</th>
                <th>Tipe</th>
                <th>nilai</th>
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
                    <td>{{ $score->student->name }}</td>
                    <td>{{ $score->task->teacher->subject->name }}</td>
                    <td>{{ $score->task->category }}</td>
                    <td>{{$score->score}}</td>
                </tr>
                <?php $prevData = $score->task->class_room->name; ?>
            @endforeach
        </tbody>
    </table>
    {{-- score end --}}
@endsection
