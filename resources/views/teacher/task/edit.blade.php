@extends('layouts.main')

@section('content')
    <form action="/task/{{$task->id}}" method="post">
        @method('PUT')
        @csrf
        <h2>Edit data tugas</h2>

        <div class="form-group">
            <label for="name">Nama Tugas</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                value="{{ $task->name }}">
        </div>
        @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
        <select name="class_room_id" class="@error('class_room_id') is-invalid @enderror">
            <option>Classroom</option>
            @foreach ($class_rooms as $class_room)
                @if ($task->class_room_id == $class_room->id)
                    <option value="{{ $class_room->id }}" selected>{{ $class_room->name }}</option>
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
        <select name="category" class="custom-select" class="@error('category') is-invalid @enderror">
            <option>category</option>
            @foreach ($categories as $category)
                @if ($task->category == $category)
                    <option value="{{ $category }}" selected>{{ $category }}</option>
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

        <input type="hidden" name="teacher_id" value="{{ auth()->user()->id }}">

        <button type="submit" class="btn btn-primary">update</button>
        <a href="/task">batal update</a>
    </form>
@endsection
