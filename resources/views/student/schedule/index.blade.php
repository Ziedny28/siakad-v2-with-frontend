@extends('layout.app')
@section('content')
    @include('partials.admin-topbar')
    @include('partials.student-sidebar')

    <!--Content Start-->
    <div class="content-start transition">
        <div class="container-fluid dashboard">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Jadwal Siswa</h4>
                            <p></p>
                            <div class="card-menu">
                            </div>
                        </div>
                        <div class="card-body">
                            <p>Ini nanti isinya gambar jadwal
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.footer')
@endsection
