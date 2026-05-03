@extends('layouts.app')

@section('content')
<div class="container">

    <h4>Detail Tugas</h4>

    <div class="card">
        <div class="card-body">

            <p><b>Judul:</b> {{ $tugas->judul }}</p>
            <p><b>Kelas:</b> {{ $tugas->kelas->nama_kelas }}</p>
            <p><b>Mapel:</b> {{ $tugas->mapel->nama_mapel }}</p>
            <p><b>Deskripsi:</b> {{ $tugas->deskripsi }}</p>
            <p><b>Deadline:</b> {{ $tugas->deadline }}</p>

            <a href="{{ route('guru.tugas.index') }}" class="btn btn-secondary">Kembali</a>

        </div>
    </div>

</div>
@endsection