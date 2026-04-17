@extends('layouts.app')

@section('content')
<div class="container">

<h3>Jadwal Siswa</h3>

@if($jadwal->isEmpty())
    <div class="alert alert-warning">
        Jadwal belum tersedia
    </div>
@endif

<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Hari</th>
        <th>Mapel</th>
        <th>Guru</th>
        <th>Jam</th>
    </tr>

    @foreach($jadwal as $j)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $j->hari }}</td>
        <td>{{ $j->mapel->nama_mapel ?? '-' }}</td>
        <td>{{ $j->guru->nama ?? '-' }}</td>
       <td>
    {{ $j->jam_mulai }} - {{ $j->jam_selesai }}
</td>
    </tr>
    @endforeach

</table>

</div>
@endsection