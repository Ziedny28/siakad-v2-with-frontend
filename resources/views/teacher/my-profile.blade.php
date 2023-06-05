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
                                <p>123457</p>
                                <hr>
                                <h6>Nama</h6>
                                <p>Admin Sutomo</p>
                                <hr>
                                <h6>Alamat</h6>
                                <p>Jl Merpati 1 nomor mawar</p>
                                <hr>
                                <h6>Tempat Tanggal Lahir</h6>
                                <p>Malang, 30 Februari 2180</p>
                                <hr>
                                <h6>Email</h6>
                                <p>emailexample@gmail.com</p>
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
