@extends('layouts.main')
@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">X</button>
        </div>
    @endif
    @include('partials.teacher-topbar')
    @include('partials.teacher-sidebar')

    <!--Content Start-->
    <div class="content-start transition">
        <div class="container-fluid dashboard">
            <div class="content-header">
                <h1>Manajemen Data Tugas</h1>
                <p></p>
            </div>

            <div class="row">
                <div class="col-md-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4 d-flex align-items-center">
                                    <i class="bx bx-task icon-home bg-success text-light"></i>
                                </div>
                                <div class="col-8">
                                    <p>Jumlah Tugas</p>
                                    <h5>{{ $taskCount }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4 d-flex align-items-center">
                                    <i class="bx bxs-graduation icon-home bg-success text-light"></i>
                                </div>
                                <div class="col-8">
                                    <p>Jumlah Siswa</p>
                                    <h5>{{ $studentCount }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Data Tugas Siswa</h4>
                            <p></p>
                            <div class="card-menu">
                                <div class="search-bar w-50">
                                    <form action="{{ route('task.index') }}" method="GET">
                                        <input type="text" class="form-control" placeholder="Search" name="search" />
                                        <button type="submit" class="btn btn-success">
                                            <i class="bx bx-search"></i>
                                        </button>
                                    </form>
                                </div>
                                <div class="btn btn-success mt-2">
                                    <a href="task/create">Buat Tugas</a>
                                </div>

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>nama tugas</th>
                                            <th>kelas</th>
                                            <th>kategori</th>
                                            <th class="w-15">aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="align-middle">
                                        @foreach ($tasks as $task)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $task->name }}</td>
                                                <td>{{ $task->class_room->name }}</td>
                                                <td>@php
                                                    echo str_replace('_', ' ', $task->category);
                                                @endphp </td>
                                                <td class="d-flex">
                                                    <button class="btn btn-success px-1">
                                                        <a class="text-white" href="/task/{{ $task->id }}/edit"><i
                                                                class="bx bx-edit"></i></a>
                                                    </button>
                                                    <form action="/task/{{ $task->id }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-danger show-alert-delete-box"
                                                            data-toggle="tooltip" title='Delete'><i
                                                                class="bx bxs-trash-alt"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <div class="paginator">
                                    {{-- paginator --}}
                                    {{ $tasks->links() }}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.footer')
    <!-- Modal -->

    {{-- modal end --}}
@endsection
