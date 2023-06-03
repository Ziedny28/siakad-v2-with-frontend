@extends('layouts.main')
@section('content')
    @include('partials.teacher-sidebar')
    @include('partials.admin-topbar')

    <div class="content-start transition">
        <div class="container-fluid dashboard">
            <div class="content-header">
                <h1>Manajemen Data Penilaian</h1>
                <p></p>
            </div>
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <form action="/score" method="post">
                            @csrf
                            <div class="card-header">
                                <h4>Input Nilai Siswa</h4>
                            </div>
                            <div class="card-body">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="class_room_id">Untuk Kelas :</label>
                                        <select class="form-select" name="class_room_id"
                                            class="@error('class_room_id') is-invalid @enderror">
                                            <option selected value="">Classroom</option>
                                        </select>
                                        @error('class_room_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="">Nama Tugas :</label>
                                        <select class="form-select" name="category"
                                            class="@error('name') is-invalid @enderror">
                                            <option selected value="">Tugas Membuat CV</option>
                                        </select>
                                        @error('category')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div>
                                        <hr>
                                    </div>
                                    <div class="form-group">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Siswa</th>
                                                    <th class="w-25">Nilai</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Andi Dwi Prasetyo</td>
                                                    <td>
                                                        <input type="text" name="score" id="score"
                                                            class="form-control @error('score') is-invalid @enderror">
                                                        @error('score')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </td>
                                                </tr>
                                                {{-- ini sample doang nanti dihapus yak --}}
                                                <tr>
                                                    <td>2</td>
                                                    <td>Raga Sang Prabu</td>
                                                    <td>
                                                        <input type="text" name="score" id="score"
                                                            class="form-control @error('score') is-invalid @enderror" value="20">
                                                        @error('score')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Ahmad Samidun</td>
                                                    <td>
                                                        <input type="text" name="score" id="score"
                                                            class="form-control @error('score') is-invalid @enderror">
                                                        @error('score')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </td>
                                                </tr>
                                                {{-- batas sample sampe sinih --}}
                                        </table>
                                    </div>
                                    <input type="hidden" name="teacher_id" value="{{ auth()->user()->id }}">
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <a class="btn btn-secondary" href="\task" role="button">Cancel</a>
                                <button class="btn btn-success" type="submit">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('partials.footer')
@endsection
