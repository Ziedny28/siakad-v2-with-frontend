@extends('layouts.main')

@section('content')
    {{ $task->name }}
    {{ $task->category }}
    <table class="table">
        <thead>
            <tr>
                <th>nama siswa</th>
                <th>nilai</th>
                <th>select</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($scores as $score)
                <tr>
                    <td>{{ $score->student->name }}</td>
                    <td>{{ $score->score }}</td>
                    <td><a href="/score/{{ $score->id }}/edit">edit</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
