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
                        <form action="/teachers/{{ $teacher->id }}" method="post">
                            @method('PUT')
                            @csrf
                            <div class="card-header">
                                <h4>Edit Data Guru </h4>
                            </div>
                            <div class="card-body">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ni">Nomor Induk Guru</label>
                                        <input type="number" name='ni' id="ni"
                                            class="form-control @error('ni') is-invalid @enderror"
                                            value="{{ $teacher->ni }}">
                                        @error('ni')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Nama</label>
                                        <input type="text" name='name' id="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ $teacher->name }}">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Alamat</label>
                                        <input type="text" name='address' id="address"
                                            class="form-control @error('address') is-invalid @enderror"
                                            value="{{ $teacher->address }}">
                                        @error('address')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="pob">Tempat/Tanggal Lahir</label>
                                        <input type="text" name='pob' id="pob"
                                            class="form-control @error('pob') is-invalid @enderror"
                                            value="{{ $teacher->pob }}">
                                        @error('pob')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    {{-- apakah admin bisa ganti password teacher? --}}
                                    {{-- <div class="form-group">
                        <label for="password">password</label>
                        <input type="password" name='password' id="password" class="form-control @error('password') is-invalid @enderror" value="{{$teacher->password}}">
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    </div> --}}

                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name='email' id="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            value="{{ $teacher->email }}">
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="subject_id">Mata Pelajaran</label>
                                        <select class="form-select" name="subject_id" id="subject_id"
                                            class="form-control @error('subject_id') is-invalid @enderror">
                                            @foreach ($subjects as $subject)
                                                @if ($subject->id == $teacher->subject_id)
                                                    <option value="{{ $subject->id }}" selected>{{ $subject->name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('subject_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    {{-- input kelas --}}
                                    <div class="form-group">
                                        <label for="class_room_id">Akses kelas</label>
                                        <select class="form-select" name="class_room_id" id="class_room_id"
                                            class="form-control @error('class_room_id') is-invalid @enderror">
                                            @foreach ($class_rooms as $class_room)
                                                    <option value="{{ $class_room->id }}">{{ $class_room->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('class_room_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <input type="hidden" name="password" value="{{ $teacher->password }}">
                                    <input type="hidden" name="id" value="{{ $teacher->id }}">
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <a class="btn btn-secondary" href="teachers" role="button">Cancel</a>
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
