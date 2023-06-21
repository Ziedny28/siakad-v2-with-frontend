@extends('layout.app')
@section('content')
    @include('partials.student-topbar')
    @include('partials.student-sidebar')

    <!--Content Start-->
    <div class="content-start transition">
        <div class="container-fluid dashboard">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Jadwal Siswa</h4>
                            <p>Kelas {{ $class_room->name }}</p>
                            <div class="card-menu">
                            </div>
                        </div>
                        <div class="card-body">
                            <div>

                                @if ($class_room->schedule != null)
                                    masuk if
                                    <img src="{{ asset('storage/' . $class_room->schedule) }}" alt=""
                                        class="img-fluid">
                                @else
                                    masuk else
                                    <img src='{{ asset('assets/images/jadwal-siswa.jpg') }}' class="img-fluid"
                                        alt="">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.footer')
@endsection
