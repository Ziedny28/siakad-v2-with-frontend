@extends('layouts.main')
@section('content')
    @include('partials.admin-sidebar')
    @include('partials.admin-topbar')

    <div class="content-start transition">
        <div class="container-fluid dashboard">
            <div class="content-header">
                <h1>Manajemen Data Siswa</h1>
                <p></p>
            </div>
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Input Jadwal Kelas </h4>
                        </div>
                        <form action="">
                            @csrf
                            <div class="card-body">
                                <div class="col-md-6">
                                    <ul>
                                        <li>
                                            <h5>input file</h5>
                                        </li>
                                        <li>
                                            1. siapkan file .png/jpg/jpeg
                                        </li>
                                        <li>
                                            2. pastikan file berukuran tidak lebih dari 3MB
                                        </li>
                                        <li>
                                            3. pastikan file berukuran 800x800 pixel
                                        </li>
                                        <li>
                                            <input type="file" name="file" id="file" class="form-control">
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <a class="btn btn-secondary" href="/students/major/mipa" role="button">Cancel</a>
                                <button class="btn btn-success" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('partials.footer')
@endsection
