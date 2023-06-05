@extends('layouts.main')
@section('content')
    @include('partials.admin-topbar')
    @include('partials.student-sidebar')

    <!--Content Start-->
    <div class="content-start transition">
        <div class="container-fluid dashboard">
            <div class="content-header">
                <h1>Mohon Maaf!</h1>
                <h1>Fitur ini belum dikembangkan :(</h1>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                         <p>fitur akan dikembangkan jika kami ada waktu</p>
                        </div>
                        <div class="card-body">
                            <img src='{{ asset('assets/images/development-features.png') }}'
                                class="img-fluid" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.footer')
@endsection
