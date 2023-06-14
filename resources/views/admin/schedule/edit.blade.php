@extends('layouts.main')
@section('content')
    @include('partials.admin-sidebar')
    @include('partials.admin-topbar')

    <div class="content-start transition">
        <div class="container-fluid dashboard">
            <div class="content-header">
                <h1>Manajemen Data Siswa</h1>
                <p></p>
            </div>
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Input Jadwal Kelas {{ $classRoom->name }}</h4>
                        </div>
                        <form action="/schedule_upload" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="col-md-6">
                                    <ul>
                                        <li>
                                            <h5>input file</h5>
                                        </li>
                                        <li class="text-black">
                                            1. siapkan file .png/jpg/jpeg
                                        </li>
                                        <li class="text-black">
                                            2. pastikan file berukuran tidak lebih dari 3MB
                                        </li>
                                        <li class="text-black">
                                            3. pastikan file berukuran 800x800 pixel
                                        </li>
                                        <li class="text-black">
                                            <label class="form-label">Schedule Image</label>
                                            <input type="hidden" name="oldScheduleImage"
                                                value="{{ $classRoom->schedule }}">
                                            @if ($classRoom->schedule)
                                                <img src="{{ asset('storage/' . $classRoom->schedule) }}"
                                                    class="img-preview img-fluid mb-3 col-sm-5 d-block">
                                            @else
                                                <img class="img-preview img-fluid mb-3 col-sm-5">
                                            @endif
                                            <input type="file" name="image" id="image" class="form-control"
                                                onchange="previewImage()">
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <input type="hidden" name="class_room_id" value={{ $classRoom->id }}>
                            <div class="card-footer text-right">
                                <a class="btn btn-secondary" href="/schedule" role="button">Cancel</a>
                                <button class="btn btn-success" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
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
