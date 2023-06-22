@extends('layout.app')
@section('content')
    @include('partials.teacher-topbar')
    @include('partials.teacher-sidebar')

    <!--Content Start-->
    <div class="content-start transition">
        <div class="container-fluid dashboard">
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Jadwal Guru</h4>
                            <h5>{{ $teacher->name }}</h5>
                            <p></p>
                            <div class="card-menu">
                            </div>
                        </div>
                        <div class="card-body">
                            <div>
                                @if ($teacher->schedule != null)
                                    <img src='{{ asset('storage/' . $teacher->schedule) }}' class="img-fluid" alt="">
                                @else
                                    <img src='{{ asset('assets/images/jadwal-guru.jpg') }}' class="img-fluid"
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
