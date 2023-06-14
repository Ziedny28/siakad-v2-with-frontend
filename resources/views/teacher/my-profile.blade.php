@extends('layout.app')
@section('content')
    @include('partials.admin-topbar')
    @include('partials.teacher-sidebar')

    <!--Content Start-->
    <div class="content-start transition">
        <div class="container-fluid dashboard">
            <div class="content-header">
                <h1>Profile Guru </h1>
                <p>(development features)</p>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Biodata</h4>
                            <div class="card-body">
                                <h6>Nomor Induk Guru</h6>
                                <p>{{ $teacher->ni }}</p>
                                <hr>
                                <h6>Nama</h6>
                                <p>{{ $teacher->name }}</p>
                                <hr>
                                <h6>Alamat</h6>
                                <p>{{ $teacher->address }}</p>
                                <hr>
                                <h6>Tempat Tanggal Lahir</h6>
                                <p>{{ $teacher->pob }}</p>
                                <hr>
                                <h6>Email</h6>
                                <p>{{ $teacher->email }}</p>
                                <hr>
                                <h6>Password</h6>
                                <a class="btn btn-light border-dark px-3 mx-0" href="/teacher-change-password">Ubah Password</a>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.footer')
@endsection
