@extends('layouts.main')
@section('content')
    @include('partials.admin-topbar')
    @include('partials.admin-sidebar')

    <!--Content Start-->
    <div class="content-start transition">
        <div class="container-fluid dashboard">
            <div class="content-header">
                <h1>Manajemen Data Guru</h1>
                <p></p>
            </div>

            <div class="row">
                <div class="col-md-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4 d-flex align-items-center">
                                    <i class="bx bxs-user icon-home bg-primary text-light"></i>
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
                                    <i class="bx bxs-graduation icon-home bg-success text-light"></i>
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
                            <h4>Data Guru</h4>
                            <p></p>
                            <div class="card-menu">
                                <div class="search-bar">
                                    <form action="#">
                                        <input type="text" class="form-control" placeholder="Search" />
                                        <button type="submit" class="btn btn-success">
                                            <i class='bx bx-search'></i>
                                        </button>
                                    </form>
                                </div>
                                <div class="btn btn-success mt-2">
                                    <a href="/teachers/create">Create New Guru</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>NIG</th>
                                            <th class="w-15">Nama</th>
                                            <th class="w-25">Alamat</th>
                                            <th>TTL</th>
                                            <th class="w-15">Mapel</th>
                                            <th >Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($teachers as $teacher)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $teacher->ni }}</td>
                                                <td>{{ $teacher->name }}</td>
                                                <td>{{ $teacher->address }}</td>
                                                <td>{{ $teacher->pob }}</td>
                                                <td>{{ $teacher->subject->name }}</td>
                                                <td><a href="/teachers/{{ $teacher->id }}/edit"
                                                        class="btn btn-success"><i class='bx bx-edit'></i></a>
                                                    <a href="/teachers/{{ $teacher->id }}/delete"
                                                        class="btn btn-danger"><i class='bx bxs-trash-alt'></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="paginator">
                                    {{-- paginator --}}
                                    {{ $teachers->links() }}
                                </div>
                            </div>
                            {{-- <div class="pagination-bar">
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
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.footer')
@endsection
