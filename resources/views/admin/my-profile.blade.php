@extends('layout.app')
@section('content')
    @include('partials.admin-topbar')
    @include('partials.admin-sidebar')

    <!--Content Start-->
    <div class="content-start transition">
        <div class="container-fluid dashboard">
            <div class="content-header">
                <h1>Profile Admin</h1>
                <p>(on development)</p>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Biodata</h4>

                            <div class="card-body">
                                <h6>Nomor Induk Admin</h6>
                                <p>{{ $admin->ni }}</p>
                                <hr>
                                <h6>Nama</h6>
                                <p>{{ $admin->name }}</p>
                                <hr>
                                <h6>Alamat</h6>
                                <p>{{ $admin->address }}</p>
                                <hr>
                                <h6>Tempat Tanggal Lahir</h6>
                                <p>{{ $admin->pob }}</p>
                                <hr>
                                <h6>Email</h6>
                                <p>{{ $admin->email }}</p>
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
