
@extends('layouts.main')
@section('content')
    @include('partials.teacher-sidebar')
    @include('partials.admin-topbar')

    <div class="content-start transition">
        <div class="container-fluid dashboard">
            <div class="content-header">
                <h1>Manajemen Data Tugas</h1>
                <p></p>
            </div>
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <form action="/task" method="post">
                            @csrf
                            <div class="card-header">
                                <h4>Edit Data Tugas </h4>
                            </div>
                            <div class="card-body">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Nama Tugas :</label>
                                        <input type="text" name="name" id="name"
                                            class="form-control @error('name') is-invalid @enderror">

                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="class_room_id">Untuk Kelas :</label>
                                        <select class="form-select" name="class_room_id" class="@error('class_room_id') is-invalid @enderror">
                                            <option selected value="">Classroom</option>
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
                                    <div class="form-group">
                                        <label for="category">Kategori Tugas :</label>
                                        <select class="form-select" name="category"
                                            class="@error('category') is-invalid @enderror">
                                            <option selected value="">category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category }}">{{ $category }}</option>
                                            @endforeach
                                        </select>
                                        @error('category')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>


                                    <input type="hidden" name="teacher_id" value="{{ auth()->user()->id }}">
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <a class="btn btn-secondary" href="\task" role="button">Cancel</a>
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
