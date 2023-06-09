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
                        <form action="/teachers/{{ $teacher->id }}" method="post" enctype="multipart/form-data">
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


                                    <div class="mb-3">
                                        <label class="form-label">Schedule Image</label>
                                        <input type="hidden" name="oldScheduleImage" value="{{ $teacher->schedule }}">

                                        @if ($teacher->schedule)
                                            <img src="{{ asset('storage/' . $teacher->schedule) }}"
                                                class="img-preview img-fluid mb-3 col-sm-5 d-block">
                                        @else
                                            <img class="img-preview img-fluid mb-3 col-sm-5">
                                        @endif

                                        <img class="img-preview img-fluid mb-3 col-sm-5">
                                        <input type="file" name="schedule" id="image" class="form-control"
                                            onchange="previewImage()">
                                    </div>

                                    {{-- input kelas --}}
                                    <div class="form-group" id="class_access">
                                        <label for="">Akses kelas</label>

                                        <div class="class_room">
                                            <div class="row">

                                                <div class="col-2">
                                                    <a class="btn btn-success" id="addColl" onclick="addColumn()"><i
                                                            class="bx bx-plus"></i> Tambahkan akses kelas </a>
                                                </div>
                                            </div>
                                            @error('inputs[0][class_room_id]')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <?php $i = 1; ?>

                                    {{-- memasukkan list kelas yang sudah assigned --}}
                                    {{-- dikasih isset, soalnya bisa saja datanya null/tidak ada ketika guru pertama dibuat --}}
                                    @isset($assigned_class_rooms)
                                        @foreach ($assigned_class_rooms as $assigned_class_room)
                                            <div class="class_room" id="class_room_{{ $i }}">
                                                <div class="row">
                                                    <div class="col-10">
                                                        <select class="form-select"
                                                            name="inputs[{{ $i }}][class_room_id]"
                                                            class="form-control @error('inputs[{{ $i }}][class_room_id]') is-invalid @enderror">
                                                            @foreach ($all_class_rooms as $class_room)
                                                                <option value="{{ $class_room->id }}"
                                                                    @if ($class_room->id === $assigned_class_room) selected="selected" @endif>
                                                                    {{ $class_room->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-2">
                                                        <a class="btn btn-danger removeColl"
                                                            onclick="removeColl({{ $i }})"><i
                                                                class="bx bxs-trash-alt"></i></a>
                                                    </div>
                                                </div>
                                                @error('inputs[{{ $i }}][class_room_id]')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            @php
                                                $i++;
                                            @endphp
                                        @endforeach
                                    @endisset

                                    <input type="hidden" name="password" value="{{ $teacher->password }}">
                                    <input type="hidden" name="id" value="{{ $teacher->id }}">
                                </div>
                            </div>

                            <div class="card-footer text-right">
                                <a class="btn btn-secondary" href="\teachers" role="button">Cancel</a>
                                <button class="btn btn-success" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let i = {{ $i }};

        function addColumn(selectedValue = "") {
            $('#class_access').append(
                `
                <div class="class_room" id="class_room_` + i + `">
                                            <div class="row">
                                                <div class="col-10">
                                                    <select class="form-select" name="inputs[` + i + `][class_room_id]"
                                                        id="inputs[` + i + `][class_room_id]"
                                                        class="form-control @error('inputs[`+i+`][class_room_id]') is-invalid @enderror">
                                                        @foreach ($class_rooms as $class_room)
                                                            <option value="{{ $class_room->id }}">{{ $class_room->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-2">
                                                    <a class="btn btn-danger removeColl" onclick="removeColl(` + i + `)">remove column</a>

                                                </div>
                                            </div>
                                            @error('inputs[`+i+`][class_room_id]')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                `
            )
            i++;
        }


        function removeColl(index) {
            console.log("remove");
            let col_item = $(`#class_room_${index}`);
            console.log(col_item);
            $(col_item).remove();
        }

        function previewImage() {
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
    @include('partials.footer')
@endsection
