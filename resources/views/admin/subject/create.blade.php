@extends('layouts.main')
@section('content')
    @include('partials.admin-sidebar')
    @include('partials.admin-topbar')

    <div class="content-start transition">
        <div class="container-fluid dashboard">
            <div class="content-header">
                <h1>Manajemen Data Mata pelajaran</h1>
                <p></p>
            </div>
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <form action="/subjects" method="post">
                            @csrf
                            <div class="card-header">
                                <h4>Create Data Mapel </h4>
                            </div>
                            <div class="card-body">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Nama :</label>
                                        <input type="text" name='name' id="name"
                                            class="form-control @error('name') is-invalid @enderror">
                                    </div>
                                    <div class="form-group">
                                        <label for="ni">Deskripsi :</label>
                                        <textarea type="text" name='description' id="description"
                                            class="form-control @error('address') is-invalid @enderror">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <a class="btn btn-secondary" href="/students" role="button">Cancel</a>
                                <button class="btn btn-success" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
