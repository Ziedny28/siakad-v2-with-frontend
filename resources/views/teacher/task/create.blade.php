@extends('layouts.main')

@section('content')
    <form action="/task" method="post">
        @csrf
        <h2>Buat data tugas</h2>
        <div class="form-group">
            <label for="name">Nama Tugas</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror">
        </div>
        @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
        <select name="class_room_id" class="@error('class_room_id') is-invalid @enderror">
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
        <select name="category" class="custom-select" class="@error('category') is-invalid @enderror">
            <option selected value="">category</option>
            @foreach ($categories as $category)
                <option value="{{$category}}">{{ $category }}</option>
            @endforeach
        </select>
        @error('category')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

        <input type="hidden" name="teacher_id" value="{{ auth()->user()->id }}">

        <button type="submit" class="btn btn-primary">submit</button>
        <a href="/task">batal buat</a>
    </form>
@endsection
