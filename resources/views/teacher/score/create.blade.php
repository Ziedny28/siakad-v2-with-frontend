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
                        <form action="{{ route('score.store') }}" method="POST">
                            @csrf
                            <div class="card-header">
                                <h4>Input Nilai Siswa</h4>
                            </div>
                            <div class="card-body">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="class_room_id">Untuk Kelas :</label>

                                        {{-- new with dependent select --}}
                                        <div class="mb-3">
                                            <select class="form-select" id="class_room_id" name="class_room_id" required>
                                                <option selected disabled>Select class Room</option>
                                                @foreach ($class_rooms as $class_room)
                                                    <option value="{{ $class_room->id }}">{{ $class_room->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        @error('class_room_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="">Nama Tugas :</label>
                                        <select class="form-select @error('name') is-invalid @enderror" name="task_id"
                                            id="task" required>
                                            <option selected value="">List Tugas</option>
                                        </select>
                                        @error('task_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div>
                                        <hr>
                                    </div>

                                    <div class="form-group">

                                        @error('inputs.*.score')
                                            <div class="alert alert-danger" role="alert">
                                                perhatikan format nilai
                                            </div>
                                        @enderror

                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Siswa</th>
                                                    <th class="w-25">Nilai</th>
                                                </tr>
                                            </thead>
                                            <tbody id="student">
                                            </tbody>
                                        </table>
                                    </div>
                                    <input type="hidden" name="teacher_id" value="{{ auth()->user()->id }}">
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <a class="btn btn-secondary" href="\task" role="button">Cancel</a>
                                <button class="btn btn-success" type="submit">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('partials.footer')

    {{-- Dependent dropdown --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $('#class_room_id').on('change', function() { //ketika kelas dipilih
                var class_room_id = this.value; //mengambil id kelas
                $('#task').html('');
                $("#student").html('');
                $.ajax({
                    url: '{{ route('getTasks') }}?class_room_id=' + class_room_id,
                    type: 'get',
                    // if success
                    success: function(res) {
                        $('#task').html('<option value="">Select Task</option>');
                        $.each(res, function(key, value) {
                            $('#task').append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                });
                $.ajax({
                    url: '{{ route('getStudents') }}?class_room_id=' + class_room_id,
                    type: 'get',
                    // if success
                    success: function(res) {
                        $('#student').html('');
                        let i = 0;
                        $.each(res, function(key, value) {
                            $('#student')
                                .append(`<tr>
                                        <td>${i+1}</td>
                                        <td>${value.name}</td>
                                        <td>
                                            <input type="number" name="inputs[${i}][score]" id="score"
                                                class="form-control @error('score') is-invalid @enderror" required>
                                        </td>
                                    </tr>`);
                            i++;
                        });
                    }
                });

            });
        });
    </script>
@endsection
