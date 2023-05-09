@extends('layout.app')
@section('content')
    @include('partials.admin-topbar')
    @include('partials.teacher-sidebar')

    <!--Content Start-->
    <div class="content-start transition">
        <div class="container-fluid dashboard">
            <div class="content-header">
                <h1>Dashboard Guru</h1>
                <h4>Selamat Datang, {{ $teacher->name }}</h4>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4 d-flex align-items-center">
                                    <i class="fas fa-inbox icon-home bg-primary text-light"></i>
                                </div>
                                <div class="col-8">
                                    <p>Jumlah Guru</p>
                                    <h5>{{$teacherCount}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4 d-flex align-items-center">
                                    <i class="fas fa-clipboard-list icon-home bg-success text-light"></i>
                                </div>
                                <div class="col-8">
                                    <p>Jumlah Siswa</p>
                                    <h5>{{$studentCount}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h4>Data Tugas Siswa</h4>
                    <div class="card">
                        <div class="card-header">
                            <a href="/task" class="btn btn-success">data tugas</a>
                            <a href="/score" class="btn btn-success">data nilai</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Mapel</th>
                                            <th>Tipe</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $prevData = ''; ?>
                                        @foreach ($scores as $score)
                                            @if ($prevData != $score->task->class_room->name)
                                                {{-- <tr>
                                                    <td>
                                                        <h4>{{ $score->task->class_room->name }}</h4>
                                                    </td>
                                                </tr> --}}
                                            @endif
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $score->student->name }}{{ $score->student->class_room_id }}</td>
                                                <td>{{ $score->task->teacher->subject->name }}</td>
                                                <td>{{ $score->task->category }}</td>
                                            </tr>
                                            <?php $prevData = $score->task->class_room->name; ?>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @include('partials.footer')
@endsection
