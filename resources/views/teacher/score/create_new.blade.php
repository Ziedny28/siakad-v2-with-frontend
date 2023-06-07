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
                                        <label for="class_room">Untuk Kelas :</label>
                                        {{-- new with select2 --}}
                                        <div class="mb-3">
                                            <select class="form-select" id="class_room" name="class_room_id" style="">

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
                                        <select class="form-select @error('task_id') is-invalid @enderror" name="task_id"
                                            id="task_id">

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

    {{-- select2 --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>

    {{-- Dependent dropdown with select2 --}}
    <script>
        $(document).ready(function() {
            $('#class_room').select2({
                placeholder: 'Pilih Kelas',
                ajax: {
                    url: "{{ route('classRoom.ajaxrequest') }}",
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                console.log(item);
                                return {
                                    id: item.id,
                                    text: item.name
                                }
                            })
                        }
                    }
                }
            })
        });
    </script>
@endsection
