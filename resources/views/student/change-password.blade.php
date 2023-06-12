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

                        {{-- input start --}}
                        <form action="/save-change-password" method="post">
                            @csrf

                            <div class="row">
                                <div class="col-5">
                                    <label for="password">Password Lama</label>
                                    <input type="password" name="password" id="password">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <label for="newPass">Password Baru</label>
                                    <input type="password" name="newPass" id="newPass">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <label for="newPassConfirm">Password Baru</label>
                                    <input type="password" name="newPassConfirm" id="newPassConfirm">
                                </div>
                            </div>

                            <input type="hidden" name="ni" value="{{ $student->ni }}">

                            <button type="submit" class="btn btn-success">submit</button>

                        </form>
                        {{-- input end --}}


                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.footer')
@endsection
