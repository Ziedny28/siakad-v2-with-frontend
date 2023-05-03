@extends('layouts.main')

@section('content')
    <h1>Tasks</h1>
    <br>
    <h1>pilih tuags</h1>
    @foreach ($tasks as $task)
        <li><a href="/score-choose-one/{{$task->id}}">edit</a> dari tugas:nama:{{ $task->name }} kelas:{{ $task->class_room->name }}
            kategori{{ $task->category }}</li>

    @endforeach
@endsection
