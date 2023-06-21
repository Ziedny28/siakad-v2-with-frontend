@extends('layouts.main')
@section('content')
    @include('partials.admin-topbar')
    @include('partials.admin-sidebar')

    <!--Content Start-->
    <div class="content-start transition">
        <div class="container-fluid dashboard">
            <div class="content-header">
                <h1>Manajemen Jadwal Kelas Siswa</h1>
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
                            <h4>Data Jadwal Kelas</h4>
                            <p></p>
                            <div class="card-menu">
                                <div class="search-bar w-50">
                                    <form action="#">
                                        <input type="text" class="form-control bg-white" placeholder="Search" />
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
                                        @foreach ($classRooms as $index => $classRoom)
                                            <tr>
                                                <td>{{ $classRooms->firstItem() + $index }}</td>
                                                <td>{{ $classRoom->name }}</td>
                                                <td>{{ $classRoom->teacher->name }}</td>
                                                <td><button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                        data-bs-target="#ModalId{{ $classRoom->id }}">
                                                        Lihat Jadwal
                                                    </button></td>
                                                <td class="flex-col">
                                                    <a href="/schedule/{{ $classRoom->id }}/schedule_edit"
                                                        class="btn btn-success"><i class='bx bx-edit'></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{ $classRooms->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach ($classRooms as $classRoom)
        <div class="modal fade" id="ModalId{{ $classRoom->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Jadwal Kelas {{ $classRoom->name }}</h5>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="card-body">
                        <div>
                            <img class="img-fluid" src='{{ asset('storage/' . $classRoom->schedule) }}'
                                alt="{{ $classRoom->name }}">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endforeach
    @include('partials.footer')
@endsection
