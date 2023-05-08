@extends('layouts.main')

@section('content')

    <a href="/students/create">buat murid baru</a>

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
                <th>Aksi</th>
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
                    <td>
                        <a href="/students/{{$student->id}}/edit" class="btn btn-success">Edit</a>
                    </td>
                </tr>
                <?php $prevData = $student->class_room_id; ?>
            @endforeach
        </tbody>
    </table>
    @endsection
