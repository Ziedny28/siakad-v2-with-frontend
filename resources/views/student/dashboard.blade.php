@extends('layouts.main')
@section('content')
    @include('partials.admin-topbar')
    @include('partials.student-sidebar')

    <!--Content Start-->
    <div class="content-start transition">
        <div class="container-fluid dashboard">
            <div class="content-header">
                <h1>Dashboard Siswa</h1>
                <h4>Selamat Datang, {{ $student->name }}</h4>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Pengumuman</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.footer')
@endsection
