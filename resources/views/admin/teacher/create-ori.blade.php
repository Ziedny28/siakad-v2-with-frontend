@extends('layouts.main')

@section('content')
<form action="/teachers" method="post">
@csrf
<div class="form-group">
    <label for="ni">NIG</label>
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
    <label for="address">address</label>
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
<div class="form-group">
    <label for="email">email</label>
    <input type="email" name='email' id="email" class="form-control @error('email') is-invalid @enderror">
    @error('email')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
@enderror
</div>
<div class="form-group">
    <label for="subject_id">mata pelajaran</label>
    <select name="subject_id" id="subject_id" class="form-control @error('subject_id') is-invalid @enderror">
        @foreach ($subjects as $subject)
            <option value="{{$subject->id}}">{{ $subject->name }}</option>
        @endforeach
    </select>
    @error('subject_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<button class="btn btn-success" type="submit">submit</button>
</form>

@endsection
