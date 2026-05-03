@extends('layouts.app')

@section('content')
<div class="container">

    <h4>Daftar Tugas</h4>

   <table class="table table-bordered">

    <thead>
        <tr>
            <th>Judul</th>
            <th>Mapel</th>
            <th>Deadline</th>
            <th>Waktu Kumpul</th>
            <th>Nilai</th>
            <th>Komentar</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
    @foreach($tugas as $t)
    <tr>

        <td>{{ $t->judul }}</td>
        <td>{{ $t->mapel->nama_mapel ?? '-' }}</td>

        <td>
            {{ \Carbon\Carbon::parse($t->deadline)->format('d M Y H:i') }}
        </td>

        <td>
            @if($t->waktu_kumpul)
                {{ \Carbon\Carbon::parse($t->waktu_kumpul)->format('d M Y H:i') }}
            @else
                -
            @endif
        </td>

        {{-- NILAI --}}
        <td>
            {{ $t->nilai ?? '-' }}
        </td>

        {{-- KOMENTAR --}}
        <td>
            {{ $t->komentar ?? '-' }}
        </td>

        {{-- STATUS --}}
        <td>
            @if($t->status == 'tepat')
                <span class="badge bg-success">Tepat</span>

            @elseif($t->status == 'telat')
                <span class="badge bg-warning text-dark">Telat</span>

            @elseif($t->status == 'lewat')
                <span class="badge bg-danger">Belum Kumpul</span>

            @else
                <span class="badge bg-secondary">Belum</span>
            @endif
        </td>

        {{-- AKSI --}}
        <td>
            @if($t->file)
                <a href="{{ route('guru.tugas.download', $t->id) }}"
                   class="btn btn-sm btn-success">
                    Download
                </a>
            @endif

            @if(!$t->waktu_kumpul && now()->lt($t->deadline))
                <a href="{{ route('siswa.tugas.kumpul', $t->id) }}"
                   class="btn btn-sm btn-primary">
                    Kumpulkan
                </a>
            @endif
        </td>

    </tr>
    @endforeach
    </tbody>

</table>

</div>
@endsection