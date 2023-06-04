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
                                            <h5>Input dari file .png/jpg/jpeg</h5>
                                        </li>
                                        <li>
                                            <p>1. siapkan file .png/jpg/jpeg berisi jadwal kelas</p>
                                        </li>
                                        <li>
                                            <p>2. pastikan file .png/jpg/jpeg sesuai dengan format yang telah ditentukan</p>
                                        </li>
                                        <li>
                                            {{-- select class_rooms --}}
                                            <div class="form-group">
                                                <label for="class_room_id">Kelas :</label>
                                                <select class="form-select" name="class_room_id"
                                                    class="@error('class_room_id') is-invalid @enderror">
                                                    @foreach ($class_rooms as $class_room)
                                                        <option value="{{ $class_room->id }}">{{ $class_room->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
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
