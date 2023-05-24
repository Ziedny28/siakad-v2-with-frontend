@extends('layouts.main')
@section('content')
    <section class="vh-100 bg-primary">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <div class="logo">
                                <img class="img-logo" src="assets/images/logo-man1.png" />
                                <h3 class="mt-4">SIAKAD</h3>
                                <h5>MAN 1 Kota Malang</h5>
                            </div>
                            <h3 class="mt-4 mb-4">Login Guru</h3>

                            <div class="form-outline mb-4 text-start">
                                <label class="form-label" for="">Nomor Induk :</label>
                                <input type="email" id="" class="form-control form-control-lg" />
                            </div>

                            <div class="form-outline mb-4 text-start">
                                <label class="form-label" for="">Password :</label>
                                <input type="password" id="" class="form-control form-control-lg" />

                            </div>

                            <button class="btn btn-success btn-lg btn-block mt-5" type="submit">Login</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
