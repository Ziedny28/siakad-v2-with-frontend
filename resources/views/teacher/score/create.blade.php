@extends('layouts.main')

@section('content')
    <h1>Tasks</h1>
    @foreach ($tasks as $task)
        <li>{{ $task }}</li>
    @endforeach
    <br>
    <h1>pilih tuags</h1>
    @foreach ($tasks as $task)
        <li><a href="/score/{{$task->id}}/create-one">buat dari tugas:</a> nama:{{ $task->name }} kelas:{{ $task->class_room->name }}
            kategori{{ $task->category }}</li>
    @endforeach
@endsection
