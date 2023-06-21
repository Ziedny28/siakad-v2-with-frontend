@extends('layouts.main')
@section('content')
    @include('partials.teacher-topbar')
    @include('partials.teacher-sidebar')

    <!--Content Start-->
    <div class="content-start transition">
        <div class="container-fluid dashboard">
            <div class="content-header">
                <h1>{{ $teacher->name }}</h1>
                <p>(change password)</p>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Ubah Password</h4>
                            <form action="/teacher-save-change-password" method="post">
                                <div class="card-body">
                                    @csrf
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password">Password Lama <span class="text-danger">*</span></label>
                                            <input class="form-control" type="password" name="password" id="password"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="newPass">Password Baru <span class="text-danger">*</span></label>
                                            <input class="form-control" type="password" name="newPass" id="newPass"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="newPassConfirm">Confirm Password <span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control" type="password" name="newPassConfirm"
                                                id="newPassConfirm" required>
                                        </div>
                                    </div>
                                    <input type="hidden" name="ni" value="{{ $teacher->ni }}">
                                </div>
                                <div class="card-footer text-right">
                                    <a class="btn btn-secondary" href="\teacher-profile" role="button">Cancel</a>
                                    <button class="btn btn-success" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.footer')
@endsection
