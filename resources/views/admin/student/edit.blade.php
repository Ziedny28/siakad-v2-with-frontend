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
                        <form action="/students/{{ $student->id }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="card-header">
                                <h4>Edit Data Guru </h4>
                            </div>
                            <div class="card-body">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ni">NIS</label>
                                        <input type="number" name='ni' id="ni"
                                            class="form-control @error('ni') is-invalid @enderror"
                                            value="{{ $student->ni }}">
                                        @error('ni')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name='name' id="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ $student->name }}">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="ni">Alamat</label>
                                        <input type="text" name='address' id="address"
                                            class="form-control @error('address') is-invalid @enderror"
                                            value="{{ $student->address }}">
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
                                            value="{{ $student->pob }}">
                                        @error('pob')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    {{-- <div class="form-group">
    <label for="password">password</label>
    <input type="password" name='password' id="password" class="form-control @error('password') is-invalid @enderror" value="{{$student->password}}">
    @error('password')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
@enderror
</div> --}}
                                    <div class="form-group">
                                        <label for="class_room_id">Kelas</label>
                                        <select class="form-select" name="class_room_id" class="@error('class_room_id') is-invalid @enderror">
                                            <option selected value="">Classroom</option>
                                            @foreach ($class_rooms as $class_room)
                                                @if ($class_room->id === $student->class_room->id)
                                                    <option selected value="{{ $class_room->id }}">{{ $class_room->name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $class_room->id }}">{{ $class_room->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>


                                    <input type="hidden" name="password" value="{{ $student->password }}">
                                    <input type="hidden" name="id" value="{{ $student->id }}">

                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <a class="btn btn-secondary" href="\students" role="button">Cancel</a>
                                <button class="btn btn-success" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
