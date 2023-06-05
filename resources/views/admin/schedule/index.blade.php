@extends('layouts.main')
@section('content')
    @include('partials.admin-topbar')
    @include('partials.admin-sidebar')

    <!--Content Start-->
    <div class="content-start transition">
        <div class="container-fluid dashboard">
            <div class="content-header">
                <h1>Manajemen Siswa Jurusan Mipa</h1>
                <p></p>
            </div>

            <div class="row">
                <div class="col-md-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4 d-flex align-items-center">
                                    <i class="bx bxs-user icon-home bg-success text-light"></i>
                                </div>
                                <div class="col-8">
                                    <p>Jumlah Guru</p>
                                    <h5>{{ $teacherCount }}</h5>
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
                            <h4>Data Siswa Mipa</h4>
                            <p></p>
                            <div class="card-menu">
                                <div class="search-bar">
                                    <form action="#">
                                        <input type="text" class="form-control" placeholder="Search" />
                                        <button type="submit" class="btn btn-success">
                                            <i class="bx bx-search"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Kelas</th>
                                            <th>Nama Wali Kelas</th>
                                            <th>Jadwal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="align-middle">
                                        @foreach ($classRooms as $classRoom)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $classRoom->name }}</td>
                                                <td>{{ $classRoom->teacher->name }}</td>
                                                <td>{{ $classRoom->schedule }}</td>
                                                <td class="flex-col">
                                                    <a href="/uploadClassRoomImage" class="btn btn-success"><i
                                                            class='bx bx-edit'></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.footer')
@endsection
