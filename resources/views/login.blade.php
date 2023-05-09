@extends('layouts.main')
@section('content')

    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-left">
                </div>
            </div>
            <div class="col-lg-5 col-12">
                <div id="auth-right">
                    <div class="logo">
                        <img src="assets/images/logo-man1.png" />
                        <h3>SIAKAD</h3>
                        <h5>MAN 1 Kota Malang</h5>
                    </div>
                    <h1 class="auth-title">Log in.</h1>
                    <p class="auth-subtitle mb-5">Masukkan Nomor Induk sebagai username</p>

                    <form class="login-form" action="/login" method="post">
                        @csrf
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" class="form-control form-control-xl" placeholder="Username" name="ni">
                            <div class="form-control-icon">
                                <i class="bx bx-user"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl" placeholder="Password" name="password">
                            <div class="form-control-icon">
                                <i class="bx bx-lock-alt"></i>
                            </div>
                        </div>
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            There were some errors with your request.
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                        <div class="login-btn">
                            <button type="submit" class="btn btn-success btn-block btn-lg shadow-lg mt-5">Log in</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
