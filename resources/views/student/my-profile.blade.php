@extends('layout.app')
@section('content')
    @include('partials.admin-topbar')
    @include('partials.student-sidebar')

    <!--Content Start-->
    <div class="content-start transition">
        <div class="container-fluid dashboard">
            <div class="content-header">
                <h1>Profile Siswa</h1>
                <p>(development features)</p>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Biodata</h4>
                            <div class="card-body">
                                <h6>Nomor Induk Siswa</h6>
                                <p>{{ $student->ni }}</p>
                                <hr>
                                <h6>Nama</h6>
                                <p>{{ $student->name }}</p>
                                <hr>
                                <h6>Alamat</h6>
                                <p>{{ $student->address }}</p>
                                <hr>
                                <h6>Tempat Tanggal Lahir</h6>
                                <p>{{ $student->pob }}</p>
                                <hr>
                                <h6>Email</h6>
                                <p>{{ $student->email }}</p>
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
