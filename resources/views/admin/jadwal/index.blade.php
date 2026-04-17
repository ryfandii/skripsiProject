@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <!-- Judul -->
    <h1 class="h3 mb-2 text-gray-800">Data Jadwal </h1>
    <p class="mb-4">Pengelolaan jadwal SMA Negeri 1 Bondowoso</p>

    <!-- Alert -->
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <!-- Card -->
    <div class="card shadow mb-4">

        <!-- Header -->
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Jadwal</h6>

            <a href="{{ route('admin.jadwal.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Jadwal
            </a>
        </div>

        <!-- FILTER -->
        <div class="card-body pb-0">
            <form method="GET" action="{{ route('admin.jadwal.index') }}">
                <div class="row">

                    <div class="col-md-4 mb-2">
                        <select name="kelas_id" class="form-control">
                            <option value="">-- Semua Kelas --</option>
                            @foreach($kelas as $k)
                                <option value="{{ $k->id }}" 
                                    {{ request('kelas_id') == $k->id ? 'selected' : '' }}>
                                    {{ $k->nama_kelas }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2 mb-2">
                        <button class="btn btn-primary btn-block">
                            <i class="fas fa-filter"></i> Filter
                        </button>
                    </div>

                    <div class="col-md-2 mb-2">
                        <a href="{{ route('admin.jadwal.index') }}" class="btn btn-secondary btn-block">
                            Reset
                        </a>
                    </div>

                </div>
            </form>

            @if(request('kelas_id') && $kelas->where('id', request('kelas_id'))->first())
                <div class="alert alert-info mt-2">
                    Menampilkan jadwal kelas: 
                    <b>{{ $kelas->where('id', request('kelas_id'))->first()->nama_kelas }}</b>
                </div>
            @endif
        </div>

        <!-- Body -->
        <div class="card-body">
            <div class="table-responsive">

            <!-- <form method="GET" class="mb-3 d-flex gap-2">
    <select name="kelas_id" class="form-control w-25">
        <option value="">-- Semua Kelas --</option>
        @foreach($kelas as $k)
            <option value="{{ $k->id }}" 
                {{ request('kelas_id') == $k->id ? 'selected' : '' }}>
                {{ $k->nama_kelas }}
            </option>
        @endforeach
    </select>

    <!-- <button class="btn btn-primary">
        <i class="fas fa-filter"></i> Filter
    </button>

    <a href="{{ route('admin.jadwal.index') }}" class="btn btn-secondary">
        Reset
    </a> -->
</form> 

                <table class="table table-bordered table-hover">

                    <thead class="thead-light text-center">
                        <tr>
                            <th>No</th>
                            <th>Kelas</th>
                            <th>Mata Pelajaran</th>
                            <th>Guru</th>
                            <th>Hari</th>
                            <th>Jam</th>
                            <th width="150px">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($jadwal as $j)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>

                            <td class="text-center">
                                <span class="badge badge-info px-3 py-2">
                                    {{ $j->kelas->nama_kelas ?? '-' }}
                                </span>
                            </td>

                            <td>
                                <b>{{ $j->mapel->nama_mapel ?? '-' }}</b>
                            </td>

                            <!-- 🔥 TAMBAHAN GURU -->
                            <td>
                                <span class="badge badge-primary px-3 py-2">
                                    {{ $j->guru->nama ?? '-' }}
                                </span>
                            </td>

                            <td class="text-center">
                                <span class="badge badge-secondary">
                                    {{ $j->hari }}
                                </span>
                            </td>

                            <td class="text-center">
                                <span class="badge badge-light">
                                   {{ \Carbon\Carbon::parse($j->jam_mulai)->format('H:i') }} 
- 
{{ \Carbon\Carbon::parse($j->jam_selesai)->format('H:i') }}
                                </span>
                            </td>

                            <td class="text-center">
@if($jadwal->isEmpty())
<tr>
    <td colspan="7" class="text-center text-muted">
        Tidak ada jadwal
    </td>
</tr>
@endif
                                <!-- EDIT -->
                                <a href="{{ route('admin.jadwal.edit', $j->id) }}" 
                                   class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <!-- DELETE -->
                                <form action="{{ route('admin.jadwal.destroy', $j->id) }}" 
                                      method="POST" 
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin hapus jadwal ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>

                            </td>
                        </tr>

                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">
                                Data jadwal belum tersedia
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