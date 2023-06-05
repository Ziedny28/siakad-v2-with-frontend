@extends('layouts.main')
@section('content')
    @include('partials.admin-sidebar')
    @include('partials.admin-topbar')

    <div class="content-start transition">
        <div class="container-fluid dashboard">
            <div class="content-header">
                <h1>Manajemen Data Guru</h1>
                <p></p>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        <div class="card-header">
                            <h4>Create Data Guru </h4>
                        </div>
                        <form action="{{ route('teacher.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="col-md-6">
                                    <ul>
                                        <li>
                                            <h5>Input dari file .csv</h5>
                                        </li>
                                        <li>
                                            <p>1. siapkan file .csv berisi data guru</p>
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
                        <form action="/teachers" method="post">
                            @csrf
                            <div class="card-body">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ni">Nomor Induk Guru :</label>
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
                                        <label for="address">Alamat :</label>
                                        <textarea type="text" name='address' id="address" rows="3"
                                            class="form-control @error('address') is-invalid @enderror"></textarea>
                                        @error('address')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group ">
                                        <label for="pob">Tempat/Tanggal Lahir :</label>
                                        <input type="text" name='pob' id="pob"
                                            class="form-control @error('pob') is-invalid @enderror"
                                            placeholder="Kota, hh Bulan tttt">
                                        @error('pob')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group ">
                                        <label for="password">Password Akun :</label>
                                        <input type="password" name='password' id="password"
                                            class="form-control @error('password') is-invalid @enderror">
                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email :</label>
                                        <input type="email" name='email' id="email"
                                            class="form-control @error('email') is-invalid @enderror">
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group ">
                                        <label for="subject_id">Mata Pelajaran</label>
                                        <select class="form-select" name="subject_id" id="subject_id"
                                            class="form-control @error('subject_id') is-invalid @enderror">
                                            @foreach ($subjects as $subject)
                                                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('subject_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <a class="btn btn-secondary" href="/teachers" role="button">Cancel</a>
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
