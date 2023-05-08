@extends('layouts.main')
@section('content')
    <!--Topbar -->

    @include('partials.admin-topbar')

    @include('partials.admin-sidebar')



    <!--Content Start-->
    <div class="content-start transition">
        <div class="container-fluid dashboard">
            <div class="content-header">
                <h1>Halo Admin, Selamat Datang!</h1>
                <p></p>
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
