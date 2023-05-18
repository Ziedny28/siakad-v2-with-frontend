@extends('layouts.main')

@section('content')
    @include('partials.admin-topbar')
    @include('partials.admin-sidebar')

    <!--Content Start-->
    <div class="content-start transition">
        <div class="container-fluid dashboard">
            <div class="content-header">
                <h1>Manajemen Data Guru</h1>
                <p></p>
            </div>
            <div class="row">

                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card">
                        <form>
                            <div class="card-header">
                                <h4>Default Validation</h4>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label>Your Name</label>
                                    <input type="text" class="form-control" required="">
                                </div>
                                <div class="mb-3">
                                    <label>Email</label>
                                    <input type="email" class="form-control" required="">
                                </div>
                                <div class="mb-3">
                                    <label>Subject</label>
                                    <input type="email" class="form-control">
                                </div>
                                <div class="form-group mb-0">
                                    <label>Message</label>
                                    <textarea class="form-control" required=""></textarea>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.footer')
@endsection
