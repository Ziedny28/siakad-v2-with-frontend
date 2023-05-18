@extends('layouts.main')

@section('content')
    @include('partials.admin-topbar')
    @include('partials.admin-sidebar')

    <!--Content Start-->
    <div class="content-start transition">
        <div class="container-fluid dashboard">
            <div class="content-header">
                <h1>Manajemen Data Guru</h1>
                <p></p>
            </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Data Guru</h4>
                            <p></p>
                        </div>
                        <div class="card-body">
                            <form action="/teachers/{{ $teacher->id }}" method="post">
                                @method('PUT')
                                @csrf

                                <h2>Edit data teacher</h2>
                                <div class="form-group">
                                    <label for="ni">NIG</label>
                                    <input type="number" name='ni' id="ni"
                                        class="form-control @error('ni') is-invalid @enderror" value="{{ $teacher->ni }}">
                                    @error('ni')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name">name</label>
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
                                    <label for="address">address</label>
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
                                    <label for="pob">pob</label>
                                    <input type="text" name='pob' id="pob"
                                        class="form-control @error('pob') is-invalid @enderror" value="{{ $teacher->pob }}">
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
                                    <label for="email">email</label>
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
                                    <label for="subject_id">mata pelajaran</label>
                                    <select name="subject_id" id="subject_id"
                                        class="form-control @error('subject_id') is-invalid @enderror">
                                        @foreach ($subjects as $subject)
                                            @if ($subject->id == $teacher->subject_id)
                                                <option value="{{ $subject->id }}" selected>{{ $subject->name }}</option>
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
                                <input type="hidden" name="password" value="{{ $teacher->password }}">
                                <input type="hidden" name="id" value="{{ $teacher->id }}">

                                <button class="btn btn-success" type="submit">submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.footer')
@endsection
