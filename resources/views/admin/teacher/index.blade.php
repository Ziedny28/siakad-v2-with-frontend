@extends('layouts.main')

@section('content')
<a href="/teacher/create">create new teacher</a>
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>NIG</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>TTL</th>
            <th>Mapel</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($teachers as $teacher)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$teacher->ni}}</td>
            <td>{{$teacher->name}}</td>
            <td>{{$teacher->address}}</td>
            <td>{{$teacher->pob}}</td>
            <td>{{$teacher->subject->name}}</td>
            <td><a href="/teacher/{{$teacher->id}}/edit" class="btn btn-success">edit</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
