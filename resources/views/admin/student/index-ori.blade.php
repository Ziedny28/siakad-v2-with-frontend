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
                                    <i class="fas fa-inbox icon-home bg-primary text-light"></i>
                                </div>
                                <div class="col-8">
                                    <p>Jumlah Guru</p>
                                    <h5>{{$teachers->count()}}</h5>
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
                                    <i class="fas fa-clipboard-list icon-home bg-success text-light"></i>
                                </div>
                                <div class="col-8">
                                    <p>Jumlah Siswa</p>
                                    <h5>{{$students->count()}}</h5>
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
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </form>
                                </div>
                                <div class="btn btn-success mt-2">
                                    <a href="/students/create">Create New Siswa</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nis</th>
                                            <th>Nama</th>
                                            <th class="w-25">Alamat</th>
                                            <th>TTL</th>
                                            <th>Kelas</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $prevData = ''; ?>
                                        @foreach ($students as $student)
                                            @if ($prevData != $student->class_room_id)
                                                <tr>
                                                    <td>
                                                        <h4>{{ $student->class_room->name }}</h4>
                                                    </td>
                                                </tr>
                                            @endif
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $student->ni }}</td>
                                                <td>{{ $student->name }}</td>
                                                <td>{{ $student->address }}</td>
                                                <td>{{ $student->pob }}</td>
                                                <td>{{ $student->class_room->name }}</td>
                                                <td>
                                                    <a href="/students/{{$student->id}}/edit" class="btn btn-success"><i class='bx bx-edit'></i></a>
                                                    <a href="/students/{{$student->id}}/delete" class="btn btn-danger"><i class='bx bx-trash-alt'></i></a>
                                                </td>
                                            </tr>
                                            <?php $prevData = $student->class_room_id; ?>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="pagination-bar">
                                <ul class="pagination pagination-success  justify-content-center">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                    </li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">Next</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.footer')
@endsection
