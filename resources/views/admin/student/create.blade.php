@extends('layouts.main')

@section('content')
<form action="/students" method="post">
@csrf
<div class="form-group">
    <label for="ni">NIS</label>
    <input type="number" name='ni' id="ni" class="form-control @error('ni') is-invalid @enderror">
    @error('ni')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="form-group">
    <label for="name">name</label>
    <input type="text" name='name' id="name" class="form-control @error('name') is-invalid @enderror">
    @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="form-group">
    <label for="ni">alamat</label>
    <input type="text" name='address' id="address" class="form-control @error('address') is-invalid @enderror">
    @error('address')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="form-group">
    <label for="pob">pob</label>
    <input type="text" name='pob' id="pob" class="form-control @error('pob') is-invalid @enderror">
    @error('pob')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="form-group">
    <label for="password">password</label>
    <input type="password" name='password' id="password" class="form-control @error('password') is-invalid @enderror">
    @error('password')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
@enderror
</div>
<select name="class_room_id" class="@error('class_room_id') is-invalid @enderror">
    <option selected value="">Classroom</option>
    @foreach ($class_rooms as $class_room)
        <option value="{{ $class_room->id }}">{{ $class_room->name }}</option>
    @endforeach
</select>
<button type="submit" class="btn btn-success">submit</button>
</form>
@endsection
