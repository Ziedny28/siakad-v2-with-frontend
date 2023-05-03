@extends('layouts.main')

@section('content')
{{$task}}


<form action="{{route('score.store')}}" method="post">
    @csrf
    <div class="form-group">
        <label for="student_id">siswa</label>
        <select name="student_id" id="student_id" class="form-control @error('student_id') is-invalid @enderror">
            @foreach($students as $student)
                <option value="{{$student->id}}">{{$student->name}}</option>
            @endforeach
        </select>
        @error('student_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
    </div>
    <div class="form-group">
        <label for="score">score</label>
        <input type="number" name="score" id="score" class="form-control @error('score') is-invalid @enderror">
        @error('score')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
    </div>
    <input type="hidden" name="task_id" value="{{$task->id}}">
    <button type="submit" class="btn btn-primary">submit</button>
</form>
@endsection
