@extends('layouts.main')

@section('content')
    halo admin,{{ $admin->name }}

    <h2>Teacher</h2>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nig</th>
                <th>Name</th>
                <th>Alamat</th>
                <th>Mapel</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($teachers as $teacher)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $teacher->ni }}</td>
                    <td>{{ $teacher->name }}</td>
                    <td>{{ $teacher->pob }}</td>
                    <td>{{ $teacher->subject->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Students</h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nis</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>TTL</th>
                <th>Kelas</th>
            </tr>
        </thead>
        <tbody>
            <?php $prevData = ''; ?>
            @foreach ($students as $student)
                @if ($prevData != $student->class_room_id)
                    <tr>
                        <td>
                            <h4>{{ $student->class_room->name }}</h4>
                        </td>
                    </tr>
                @endif
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $student->ni }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->address }}</td>
                    <td>{{ $student->pob }}</td>
                    <td>{{ $student->class_room->name }}</td>
                </tr>
                <?php $prevData = $student->class_room_id; ?>
            @endforeach
        </tbody>
    </table>
    <table class="table">
        <thead>
            <tr>
                <th>Nama Mapel</th>
                <th>daftar guru pengejar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($subjects as $subject)
                <tr>
                    <td>{{ $subject->name }}</td>
                    <td>
                        @foreach ($subject->teachers as $teacher)
                            <li>{{ $teacher->name }}</li>
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <table class="table">
        <thead>
            <tr>
                <th>nama kelas</th>
                <th>wali kelas</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($class_rooms as $class_room)
                <tr>
                    <td>{{ $class_room->name }}</td>
                    <td>
                        {{ $class_room->teacher->name }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
