@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1 fw-bold">Manajemen Tugas</h4>
            <small class="text-muted">Kelola dan pantau tugas yang diberikan kepada siswa</small>
        </div>

        <a href="{{ route('guru.tugas.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Tugas
        </a>
    </div>

    <!-- CARD -->
    <div class="card shadow-sm border-0">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-hover align-middle">

                    <thead class="table-light">
    <tr>
        <th>Judul</th>
        <th>Kelas</th>
        <th>Mata Pelajaran</th>
        <th>Pengumpulan</th> {{-- 🔥 baru --}}
        <th>Status</th> {{-- 🔥 baru --}}
        <th>File</th>
        <th>Deadline</th>
        <th class="text-center">Aksi</th>
    </tr>
</thead>

                  <tbody>
@forelse($tugas as $t)
<tr>
    <td class="fw-semibold">{{ $t->judul }}</td>

    <td>{{ $t->kelas->nama_kelas ?? '-' }}</td>

    <td>{{ $t->mapel->nama_mapel ?? '-' }}</td>

    {{-- 🔥 JUMLAH PENGUMPULAN --}}
    <td>
        <span class="badge bg-primary">
            {{ $t->pengumpulan_count }} / {{ $t->total_siswa }}
        </span>
    </td>

    {{-- 🔥 STATUS DEADLINE --}}
    <td>
        @if(now()->gt($t->deadline))
            <span class="badge bg-danger">Lewat</span>
        @else
            <span class="badge bg-success">Aktif</span>
        @endif
    </td>

    {{-- FILE --}}
    <td>
        @if($t->file)
            <a href="{{ route('guru.tugas.download', $t->id) }}" class="btn btn-sm btn-success">
                Download
            </a>
        @else
            -
        @endif
    </td>

    {{-- DEADLINE --}}
    <td>
        <span class="badge bg-light text-dark">
            {{ \Carbon\Carbon::parse($t->deadline)->format('d M Y H:i') }}
        </span>
    </td>

    {{-- AKSI --}}
    <td class="text-center">

        <a href="{{ route('guru.tugas.pengumpulan', $t->id) }}"
           class="btn btn-sm btn-primary mb-1">
            Pengumpulan
        </a>

        <a href="{{ route('guru.tugas.show', $t->id) }}"
           class="btn btn-sm btn-info mb-1">
            Detail
        </a>

        <a href="{{ route('guru.tugas.edit', $t->id) }}"
           class="btn btn-sm btn-warning">
            Edit
        </a>

    </td>
</tr>
@empty
<tr>
    <td colspan="8" class="text-center text-muted">
        Belum ada tugas
    </td>
</tr>
@endforelse
</tbody>

                </table>
            </div>

        </div>
    </div>

</div>
@endsection