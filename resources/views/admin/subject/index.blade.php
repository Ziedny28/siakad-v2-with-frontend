@extends('layouts.main')
@section('content')
    @include('partials.admin-topbar')
    @include('partials.admin-sidebar')

    <!--Content Start-->
    <div class="content-start transition">
        <div class="container-fluid dashboard">
            <div class="content-header">
                <h1>Manajemen Data Mata Pelajaran</h1>
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
                                    <h5>{{ $teachers->count() }}</h5>
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
                                    <h5>{{ $students->count() }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Data Mata Pelajaran</h4>
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
                                <div class="btn btn-success mt-2">
                                    <a href="/subjects/create">Create New Mapel</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="w-15">#</th>
                                            <th class="w-25">Nama Mapel</th>
                                            <th class="w-25">Deskripsi</th>
                                            <th class="w-25">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="align-middle">
                                        @foreach ($subjects as $subject)
                                            <tr>
                                                <td>{{ $subject->id }}</td>
                                                <td>{{ $subject->name }}</td>
                                                <td>
                                                    {{ $subject->description }}
                                                </td>
                                                <td>
                                                    <a href="/subjects/create" class="btn btn-success"><i
                                                            class='bx bx-edit'></i></a>
                                                    <form action="/subjects/{{ $subject->id }}" method="post">
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
                                <div class="pagination">
                                    {{-- {{$subjects->links()}} --}}
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
