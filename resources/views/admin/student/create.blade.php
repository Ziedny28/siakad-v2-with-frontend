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
                            <h4>Create Data Siswa </h4>
                        </div>
                        <form action="{{ route('student.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="col-md-6">
                                    <ul>
                                        <li>
                                            <h5>Input dari file .csv</h5>
                                        </li>
                                        <li>
                                            <p>1. siapkan file .csv berisi data siswa</p>
                                        </li>
                                        <li>
                                            <p>2. pastikan file .csv sesuai dengan format yang telah ditentukan</p>
                                        </li>
                                        <li>
                                            <p>3. pastikan file .csv tidak melebihi 2MB</p>
                                        </li>
                                        <li>
                                            <p>4. pastikan file .csv tidak kosong</p>
                                        </li>
                                        <li>
                                            <p>5. pastikan file .csv tidak mengandung data yang sama</p>
                                        </li>
                                        <li>
                                            {{-- input file .csv --}}
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
                        <form action="/students" method="post">
                            @csrf
                            <div class="card-body">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ni">NIS :</label>
                                        <input type="number" name='ni' id="ni"
                                            class="form-control @error('ni') is-invalid @enderror">
                                        @error('ni')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Nama :</label>
                                        <input type="text" name='name' id="name"
                                            class="form-control @error('name') is-invalid @enderror">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="ni">Alamat :</label>
                                        <textarea type="text" name='address' id="address" rows="3"
                                            class="form-control @error('address') is-invalid @enderror"></textarea>
                                        @error('address')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="pob">Tempat/Tanggal Lahir :</label>
                                        <input type="text" name='pob' id="pob"
                                            class="form-control @error('pob') is-invalid @enderror"
                                            placeholder="contoh : Malang, 20 Mei 2001">
                                        @error('pob')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password :</label>
                                        <input type="password" name='password' id="password"
                                            class="form-control @error('password') is-invalid @enderror">
                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="class_room_id">Kelas :</label>
                                        <select class="form-select" name="class_room_id"
                                            class="@error('class_room_id') is-invalid @enderror">
                                            @foreach ($class_rooms as $class_room)
                                                <option value="{{ $class_room->id }}">{{ $class_room->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
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
