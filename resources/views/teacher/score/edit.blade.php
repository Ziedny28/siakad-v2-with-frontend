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
                        <form action="/score/{{ $score->id }}" method="post">
                            @method('PUT')
                            @csrf
                            <div class="card-header">
                                <h4>Edit Nilai Siswa </h4>
                            </div>
                            <div class="card-body">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Nama Tugas</label>
                                        <input type="text" name="name" id="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ $task->name }}">
                                    </div>
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <div class="form-group">
                                        <label for="name">Kelas</label>
                                        <select class="form-select" name="class_room_id"
                                            class="@error('class_room_id') is-invalid @enderror">
                                            <option></option>
                                            @foreach ($class_rooms as $class_room)
                                                @if ($task->class_room_id == $class_room->id)
                                                    <option value="{{ $class_room->id }}" selected>{{ $class_room->name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $class_room->id }}">{{ $class_room->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('class_room_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Kategori</label>
                                        <select class="form-select" name="category" class="custom-select"
                                            class="@error('category') is-invalid @enderror">
                                            <option></option>
                                            @foreach ($categories as $category)
                                                @if ($task->category == $category)
                                                    <option value="{{ $category }}" selected>{{ $category }}
                                                    </option>
                                                @else
                                                    <option value="{{ $category }}">{{ $category }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('category')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
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
