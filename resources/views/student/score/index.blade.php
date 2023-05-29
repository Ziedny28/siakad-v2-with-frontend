    @extends('layout.app')
    @section('content')
        @include('partials.admin-topbar')
        @include('partials.student-sidebar')

        <!--Content Start-->
        <div class="content-start transition">
            <div class="container-fluid dashboard">
                <div class="row">
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
                                                <th>Nilai</th>
                                                <th>Tipe</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $prevData = ''; ?>
                                            @foreach ($scores as $score)
                                                @if ($prevData != $score->task->teacher->subject->name)
                                                    <tr>
                                                        <th>
                                                            {{ $score->task->teacher->subject->name }}

                                                        </th>
                                                    </tr>
                                                @endif
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $score->task->teacher->subject->name }}</td>
                                                    <td>{{ $score->task->teacher->name }}</td>
                                                    <td>{{ $score->score }}</td>
                                                    <td>{{ $score->task->category }}</td>
                                                </tr>
                                                <?php $prevData = $score->task->teacher->subject->name; ?>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <div class="paginator">
                                        {{-- paginator --}}
                                        {{ $scores->links() }}
                                    </div>


                                </div>
                                {{-- <div class="pagination-bar">
                                    <ul class="pagination pagination-success  justify-content-center">
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                        </li>
                                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">Next</a>
                                        </li>
                                    </ul>
                                </div> --}}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('partials.footer')
    @endsection
