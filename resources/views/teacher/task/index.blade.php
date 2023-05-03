@extends('layouts.main')

@section('content')
    {{-- task start --}}
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <h4>Tasks</h4>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>nama tugas</th>
                <th>kelas</th>
                <th>kategori</th>
                <th>aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{ $task->name }}</td>
                <td>{{ $task->class_room->name }}</td>
                <td>{{ $task->category }}</td>
                <td><a class="btn btn-success"href="/task/{{$task->id}}/edit">edit</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{-- task end --}}

    <a href="task/create" class="btn btn-success">buat tugas baru</a>
    <a href="/dashboard-teacher">kembali ke dashboard</a>
@endsection
