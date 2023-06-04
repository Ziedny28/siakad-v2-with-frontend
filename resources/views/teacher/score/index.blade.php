@extends('layouts.main')

@section('content')
    {{-- score start --}}
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @include('partials.admin-topbar')
    @include('partials.teacher-sidebar')

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
                                    <h5>must edit</h5>
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
                                    <h5>must edit</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Data Guru</h4>
                            <p></p>
                            <div class="card-menu">
                                <div class="search-bar w-50">
                                    <form action="#">
                                        <select class="form-select" name="class_room_id" id="">
                                            <option>Semua</option>
                                            @foreach ($class_rooms as $class_room)
                                                <option value="{{ $class_room->id }}">{{ $class_room->name }}</option>
                                            @endforeach
                                        </select>
                                        <button type="submit" class="btn btn-success">
                                            <i class="bx bx-search"></i>
                                        </button>
                                    </form>
                                </div>
                                <div class="btn btn-success mt-2">
                                    <a href="/score/create">Insert Nilai</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama</th>
                                            <th>Kelas</th>
                                            <th>Tugas</th>
                                            <th>Tipe</th>
                                            <th>nilai</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="align-middle">
                                        @foreach ($scores as $score)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $score->student->name }}</td>
                                                <td>{{ $score->student->class_room->name }}</td>
                                                <td>{{ $score->task->name }}</td>
                                                <td>{{ $score->task->category }}</td>
                                                <td>{{ $score->score }}</td>
                                                <td><button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                        data-bs-target="#ModalUbah{{ $score->id }}">
                                                        <i class="bx bxs-edit"></i>
                                                    </button></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="paginator">
                                    {{-- paginator --}}
                                    {{ $scores->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    @foreach ($scores as $score)
        <div class="modal fade" id="ModalUbah{{ $score->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Nilai Siswa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="">
                        <div class="modal-body">
                            {{-- get student name --}}
                            <p>Nama : {{ $score->student->name }}</p>
                            {{-- input score --}}
                            <div class="form-group">
                                <label for="score">Ubah Nilai</label>
                                <input type="text" name="score" id="score" class="form-control w-15"
                                    value="{{ $score->score }}">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    {{-- score end --}}
    @include('partials.footer')
@endsection
