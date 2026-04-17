@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <!-- Header + Button -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-gray-800">Data Nilai Siswa</h1>

        <a href="{{ route('guru.nilai.input') }}" class="btn btn-primary">
            + Input Nilai
        </a>
    </div>

    <!-- Card -->
    <div class="card shadow">
        <div class="card-body">

            <table class="table table-bordered">
               <thead>
<tr>
    <th>No</th>
    <th>Nama Siswa</th>
    <th>Kelas</th>
    <th>Mata Pelajaran</th>
    <th>Nilai</th>
    <th>Aksi</th> <!-- 🔥 TAMBAH -->
</tr>
</thead>
                <tbody>
                    @forelse($nilai as $n)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $n->siswa->nama ?? '-' }}</td>
                        <td>{{ $n->siswa->kelas->nama_kelas ?? '-' }}</td>
                        <td>{{ $n->mapel->nama_mapel ?? '-' }}</td>
                        <td>{{ $n->nilai }}</td>

<td>
    <a href="{{ route('guru.nilai.edit', $n->id) }}" class="btn btn-warning btn-sm">
        Edit
    </a>
</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">Belum ada data</td>
                    </tr>
                    @endforelse
                </tbody>
                <form method="GET" action="{{ route('guru.nilai.index') }}" class="mb-3">
    <div class="row">
        <div class="col-md-4">
            <select name="kelas_id" class="form-control" onchange="this.form.submit()">
                <option value="">-- Semua Kelas --</option>
                @foreach($kelas as $k)
                    <option value="{{ $k->id }}"
                        {{ request('kelas_id') == $k->id ? 'selected' : '' }}>
                        {{ $k->nama_kelas }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</form>
            </table>

        </div>
    </div>

</div>
@endsection