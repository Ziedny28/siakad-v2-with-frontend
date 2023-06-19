    @extends('layout.app')
    @section('content')
        @include('partials.admin-topbar')
        @include('partials.student-sidebar')

        <!--Content Start-->
        <div class="content-start transition">
            <div class="container-fluid dashboard">
                <div class="row">
                    <div class="col-md-6 col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4 d-flex align-items-center">
                                        <i class="bx bx-task icon-home bg-success text-light"></i>
                                    </div>
                                    <div class="col-8">
                                        <p>Jumlah Tugas</p>
                                        <h5>{{ $taskCount }}</h5>
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
                                        <i class="bx bx-task icon-home bg-success text-light"></i>
                                    </div>
                                    <div class="col-8">
                                        <p>Nilai Rata-rata</p>
                                        <h5>{{ $scoreAvg }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Data Nilai</h4>
                                <p></p>
                                <div class="card-menu">
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Mata Pelajaran</th>
                                                <th>Guru</th>
                                                <th>Tugas</th>
                                                <th>Tipe</th>
                                                <th>Nilai</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $prevData = ''; ?>
                                            @foreach ($scores as $score)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $score->task->teacher->subject->name }}</td>
                                                    <td>{{ $score->task->teacher->name }}</td>
                                                    <td>{{ $score->task->name }}</td>
                                                    <td>@php
                                                        echo str_replace('_', ' ', $score->task->category);
                                                    @endphp </td>
                                                    <td>{{ $score->score }}</td>
                                                </tr>
                                                <?php $prevData = $score->task->teacher->subject->name; ?>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <div class="paginator">
                                        {{-- paginator --}}
                                        {{ $scores->links('partials.paginate') }}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('partials.footer')
    @endsection
