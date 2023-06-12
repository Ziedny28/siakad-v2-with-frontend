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
                            <h4>Data Siswa {{ $major }}</h4>
                            <p></p>
                            <div class="card-menu">
                                <div class="search-bar w-50">
                                    <form action="{{ route('student.search') }}">
                                        <input type="text" name="query" class="form-control bg-white"
                                            placeholder="Search" />
                                        <input type="hidden" name="major" value="{{ $major }}">
                                        <button type="submit" class="btn btn-success">
                                            <i class='bx bx-search'></i>
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
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nis</th>
                                            <th>Nama</th>
                                            <th class="w-25">Alamat</th>
                                            <th>Email</th>
                                            <th>Kelas</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="align-middle">
                                        @foreach ($students as $i => $student)
                                            <tr>
                                                <td>{{ $students->firstItem() + $i }}</td>
                                                <td>{{ $student->ni }}</td>
                                                <td>{{ $student->name }}</td>
                                                <td>{{ $student->address }}</td>
                                                <td>{{ $student->email }}</td>
                                                <td>{{ $student->class_room->name }}</td>
                                                <td class="d-flex">
                                                    <button class="btn btn-success px-1">
                                                        <a href="/students/{{ $student->id }}/edit" class="text-white"><i
                                                                class='bx bx-edit'></i></a>
                                                    </button>
                                                    <form action="/students/{{ $student->id }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-danger"><i
                                                                class='bx bxs-trash-alt'></i></button>
                                                    </form>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="paginator">
                                    {{-- paginator --}}
                                    {{ $students->links() }}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.footer')
@endsection
